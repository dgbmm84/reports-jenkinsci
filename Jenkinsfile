#!/usr/bin/env groovy

/*node('master') {
    try {
        stage('Build') {
            // Checkout the app at the given commit sha from the webhook
            checkout scm
            agent { docker { image 'composer:latest' } }
            // Install dependencies, create a new .env file and generate a new key, just for testing
            sh "cd app/reports"
            composer install
        }

        stage('Checks') {
            steps {
                parallel {
                    PhpUnit: {
                        node('PhpUnit') {
                            checkout scm
                            try {
                               agent { docker { image 'phpunit:latest' } }
                            }
                            finally {
                                sh 'cd app/reports'
                                sh 'phpunit --bootstrap vendor/autoload.php tests'
                            }
                        }
                    }
                    Sniffer: {
                        node('Sniffer') {
                            try {
                                agent { docker { image 'pipelinecomponents/php-codesniffer:latest' } }
                            } finally {
                                sh 'cd app/reports'
                                sh 'phpcs --extensions=php --standard=PSR2 src/Framework/Controller/ClassPhpCS.php'
                            }
                        }
                    }
                }
            }
        }

        stage('deploy PROD') {
            // If we had ansible installed on the server, setup to run an ansible playbook
            // sh "ansible-playbook -i ./ansible/hosts ./ansible/deploy.yml"
            sh "echo 'WE ARE DEPLOYING master'"
        }
    } catch(error) {
        throw error
    } finally {
        // Any cleanup operations needed, whether we hit an error or not
    }

}*/
node {
    stage('preparation') {
        checkout scm
        agent { docker { image 'composer:latest' } }
    }
    stage("composer_install") {
        // Run `composer update` as a shell script
        sh 'cd app/reports && composer install'
    }
    stage("phpunit") {
        // Run PHPUnit
        sh 'cd app/reports && vendor/bin/phpunit --bootstrap vendor/autoload.php tests'
    }
}
