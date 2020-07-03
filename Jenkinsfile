#!/usr/bin/env groovy

pipeline {
    agent any

    stages {
        stage('Build') {
            agent { docker { image 'composer:latest' } }
            steps {
                checkout scm
                sh 'pwd && ls -lrt'
                //sh 'apt-get update -y'
                //sh 'apt-get install -y zip unzip'
                //sh 'php -r "copy(\'https://getcomposer.org/installer\', \'composer-setup.php\');"'
                //sh 'php composer-setup.php'
                //sh 'php -r "unlink(\'composer-setup.php\');"'
                //sh 'php composer.phar install'
                sh 'cd app/reports && composer install'
            }
        }
        stage('Lints/Smells') {
            parallel {
                stage('php_unit') {
                   steps {
                        sh 'apt install -y wget'
                        sh 'wget -O phpunit https://phar.phpunit.de/phpunit-9.phar'
                        sh 'chmod +x phpunit'
                        sh 'pwd && ls -lrt'
                        sh 'cd app/reports && ../../phpunit --bootstrap vendor/autoload.php tests'
                    }
                }
                stage('sniffer') {
                    steps {
                        checkout scm
                        sh 'apt-get -y update && apt-get install -y php-pear'
                        sh 'pear install PHP_CodeSniffer'
                        // - phpcs --extensions=php src/Framework/Controller # Path for checking entire project
                        sh 'pwd && ls -lrt'
                        sh 'cd app/reports && phpcs --extensions=php --standard=PSR2 src/Framework/Controller/ClassPhpCS.php'
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