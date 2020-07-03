#!/usr/bin/env groovy

pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                checkout scm
                sh 'pwd && ls -lrt && cd app/reports'
                sh 'sudo apt-get update'
                sh 'sudo apt-get install zip unzip'
                sh 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"'
                sh 'php composer-setup.php'
                sh 'php -r "unlink(\'composer-setup.php\');"'
                sh 'php composer.phar install'
            }
        }
        stage('Lints/Smells') {
            parallel {
                stage('php_unit') {
                   steps {
                        checkout scm
                        sh 'cd app/reports && apt install -y wget'
                        sh 'wget -O phpunit https://phar.phpunit.de/phpunit-9.phar'
                        sh 'chmod +x phpunit'
                        sh './phpunit --bootstrap vendor/autoload.php tests'
                    }
                }
                stage('sniffer') {
                    steps {
                        checkout scm
                        sh 'sudo apt-get update'
                        sh 'pear install PHP_CodeSniffer'
                        // - phpcs --extensions=php src/Framework/Controller # Path for checking entire project
                        sh 'cd app/reports && pwd && ls -lrt'
                        sh 'phpcs --extensions=php --standard=PSR2 src/Framework/Controller/ClassPhpCS.php'
                    }
                }
            }
        }
        stage('Push') {
            when {
                branch 'master'
            }
            steps {
                echo 'Deploying docker images master again'

            }
        }
    }
}