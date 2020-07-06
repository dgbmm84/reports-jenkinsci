#!/usr/bin/env groovy

pipeline {
    agent any
    stages { // stages contains all entire workflow of pipeline
        /*stage('Checkout') {
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
                            pwd && ls -lrt
                            cd app/reports
                            phpcs -v --extensions=php --standard=PSR2 src/Framework/Controller/ClassPhpCS.php
                           '''
                    }
                }
            }
        }*/
        stage('Push') {
            when {
                branch 'master'
            }
            steps {
                script {
                    try {
                        sh '''
                        apt install -y python3-pip && pip3 --version
                        pip3 install Fabric3==1.13.1.post1 && fab --version
                        '''
                        echo '${env.ENV_FILE_PROD}'
                        echo '${env.ENV_MYSQL_FILE}'
                        //sshagent(credentials : ['dbe6289b-1e73-455e-b9b5-5dbde44d3b18']) {
                        //    sh 'fab production deploy:env_file="${ENV_FILE_PROD}",mysql_env_file="${ENV_MYSQL_FILE}"'
                        //}
                    } catch(e) {
                        echo 'Impossible establish connection SSH'
                        echo 'Err: Incremental Build failed with Error: ' + e.toString()
                    }
                }
            }
        }
    }
}