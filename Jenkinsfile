#!/usr/bin/env groovy

pipeline {
    agent any
    stages {
        stage('Build') {
            agent { docker { image 'composer:latest' } }
            steps {
                checkout scm
                sh 'pwd && ls -lrt'
                sh 'cd app/reports && composer install'
            }
        }
        stage('Lints/Smells') {
            parallel {
                stage('php_unit') {
                    agent { docker { image 'php:7.3' } }
                    steps {
                        script {
                            try {
                                sh '''
                                    cd app/reports
                                    apt install -y wget
                                    wget -O phpunit https://phar.phpunit.de/phpunit-9.phar
                                    chmod +x phpunit
                                    pwd && ls -lrt
                                   '''
                            } finally {
                                sh '''
                                    cd app/reports
                                    ls -lrt
                                    ./phpunit --bootstrap vendor/autoload.php tests
                                   '''
                            }
                        }
                    }
                }
                stage('sniffer') {
                    steps {
                        script {
                            try {
                                sh '''
                                    apt-get -y update
                                    apt-get install -y php-pear
                                    pear install PHP_CodeSniffer
                                    // - phpcs --extensions=php src/Framework/Controller # Path for checking entire project
                                    pwd && ls -lrt
                                   '''
                            } catch(e) {
                                sh '''
                                    cd app/reports
                                    phpcs -v --extensions=php --standard=PSR2 src/Framework/Controller/ClassPhpCS.php
                                   '''
                            }
                        }
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