import os

from fabric.operations import run
from fabric.state import env
from fabric.context_managers import cd
from fabric.api import warn_only, task
import json

environments = {
    'production': {
        'hosts': 'medion@2.tcp.ngrok.io:18984',
        'home': '/home/medion/deploys/docker-pipeline-jenkins-symfony-reports/production',
        'docker_build_commands': [
            'docker-compose -f docker-compose-prod.yaml build --no-cache',
            'docker-compose -f docker-compose-prod.yaml down',
            'docker-compose -f docker-compose-prod.yaml up -d',
        ],
        'docker_clean_commands': [
            'docker rmi $(docker images -q -f "dangling=true")',
            # 'docker volume rm $(docker volume ls -qf dangling=true)',
        ],
        'git': {
            'parent': 'origin',
            'branch': 'master',
        },
        'env': {
            'app': [
                'app/reports/.env.prod', # It's mandatory for docker-compose yaml
                'app/reports/.env', # It's mandatory for composer install dockerfile
             ],
            'mysql': 'mysql/.env'
        }
    },
    'develop': {
        'hosts': 'medion@2.tcp.ngrok.io:18984',
        'home': '/home/medion/deploys/docker-pipeline-jenkins-symfony-reports/develop',
        'docker_build_commands': [
            'docker-compose -f docker-compose-dev.yaml build --no-cache',
            'docker-compose -f docker-compose-dev.yaml down',
            'docker-compose -f docker-compose-dev.yaml up -d',
        ],
        'docker_clean_commands': [
            'docker rmi $(docker images -q -f "dangling=true")',
            # 'docker volume rm $(docker volume ls -qf dangling=true)',
        ],
        'git': {
            'parent': 'origin',
            'branch': 'develop',
        },
        'env': {
            'app': 'app/reports/.env',
            'mysql': 'mysql/.env'
        }
    }
}

def production():
    environments['default'] = environments['production']
    env.hosts = environments['production']['hosts']


def stage():
    environments['default'] = environments['develop']
    env.hosts = environments['develop']['hosts']


def deploy(env_file=None, mysql_env_file=None):
    sha1 = os.environ.get('CI_COMMIT_SHA')
    print("SHA Commit", os.environ.get('CI_COMMIT_SHA'))
    git_pull(sha1, env_file, mysql_env_file)
    docker_commands()


def git_pull(sha1, env_file, mysql_env_file):
    with cd(environments['default']['home']):
        print("Running git pull on ", environments['default']['git']['parent'], environments['default']['git']['branch'])
        run('git pull %s %s' % (environments['default']['git']['parent'],
                                environments['default']['git']['branch']))
        compose_env_file(env_file, mysql_env_file)


def compose_env_file(env_file, mysql_env_file):
     print(env_file, mysql_env_file)
     if env_file:
        env_file_json = json.loads(env_file)

        with cd(environments['default']['home']):
            if type(environments['default']['env']['app']).__name__ == 'list':
                for base_file in environments['default']['env']['app']:
                    fill_envs(env_file_json, base_file)
            else:
                fill_envs(env_file_json, base_file)

     if mysql_env_file:
         env_file_json = json.loads(mysql_env_file)
         fill_envs(env_file_json, environments['default']['env']['mysql'])


def fill_envs(env_json, path):
    counter_key = 1
    with cd(environments['default']['home']):
        for key in env_json:
            value = env_json[key]
            run ('echo "%s=%s" > %s' % (key, value, path)) if counter_key == 1 else run ('echo "%s=%s" >> %s' % (key, value, path))
            counter_key += 1


def docker_commands():
    with cd(environments['default']['home']):
        for command in environments['default']['docker_build_commands']:
            run(command)

    with warn_only():
        with cd(environments['default']['home']):
            for command in environments['default']['docker_clean_commands']:
                run(command)


