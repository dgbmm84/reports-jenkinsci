#!/usr/bin/env groovy

pipeline {
    agent any
    stages { // stages contains all entire workflow of pipeline
        stage('Checkout') {
            steps {
                checkout scm // Command jenkins for pulling project
            }
        }
        stage('Lints/Smells') { // That stage splits in 2 parallel stages
            parallel {
                stage('php_unit') {
                    agent { docker { image 'composer:latest' } } // In that case stage uses docker image
                    steps {
                        script {
                            try { // Always trying this script
                                sh '''
                                    cd app/reports
                                    composer install
                                    wget -O phpunit https://phar.phpunit.de/phpunit-9.phar
                                    chmod +x phpunit
                                    pwd && ls -lrt
                                   '''
                            } finally { // Whatever occurs before, it always is executed
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
                        // | true - ignores error bash in case of pear already installed, continuing execution
                        sh '''
                            apt-get -y update
                            apt-get install -y php-pear
                            pear install PHP_CodeSniffer || true
                            // - phpcs --extensions=php src/Framework/Controller # Path for checking entire project
                            pwd && ls -lrt
                            cd app/reports
                            phpcs -v --extensions=php --standard=PSR2 src/Framework/Controller/ClassPhpCS.php
                           '''
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