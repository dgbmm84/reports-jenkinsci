#!/usr/bin/env groovy

pipeline {
    agent any

    stages {
        stage('Build') {
            agent {
                docker {
                    image 'composer:latest'
                }
            }
            steps {
                sh 'cd app/reports'
                sh 'composer install'
            }
        }
        stage('Test') {
            parallel {
                stage('php_unit') {
                    agent {
                        docker {
                            image 'php_unit:latest'
                        }
                    }
                    steps {
                        sh 'cd app/reports'
                        sh 'phpunit --bootstrap vendor/autoload.php tests'
                    }
                }
                stage('sniffer') {
                    agent {
                        docker {
                            image 'php:7.3'
                        }
                    }
                    steps {
                        sh 'apt-get update'
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
                echo 'Deploying docker images'

            }
        }
    }
}