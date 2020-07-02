---
Depliegue usando Jenkins usando un docker-compose PROD
---

Configuration Jeninks

    Instalar Jenkins en la máquina o bajarse una instancia de docker con jenkins (Iniciaremos la 2ª opción)
        - docker pull jenkins/jenkins:lts
        - Usage: https://github.com/jenkinsci/docker/blob/master/README.md 
            - docker run -p 8080:8080 -p 50000:50000 -v jenkins_home:/var/jenkins_home jenkins/jenkins:lts
            - http://localhost:8080/
    
    Instalar los plugins correspondientes para la integración con el repositorio de GitHub    
        - Instalar los plugins de Blue Ocean ( UI que ayuda a la integración ) 
    Creación de un pipeline usando el Plugin BlueOcean
        https://www.jenkins.io/doc/tutorials/create-a-pipeline-in-blue-ocean/
        - http://localhost:8080/blue/create-pipeline 
            1.- Lo conectamos con GitHub
            2.- Crear AccessToken dentro de GitHub para dar permisos de acceso ( Link es propocionado directamente por blueOcean ) 
                - Se queda guardado en https://github.com/settings/tokens (Sección PersonalAccessTokens)
                (Este path se encuentra tamiben en https://github.com/settings/profile - Developer Settings/PersonalAccessTokens)
            3.- Elegimos el repositorio al que conectarnos
    
    Esta desarrollo nos creará pipelines con una configuración base Oauth contra el repositorio. Falta añadir al root del projecto el fichero Jenkinsfile.
             
Host de despliegue 

    - Es local haciendo uso de ngrok para configurar un tunnel por tcp dad una ip pública:
    - No hay necesidad de configurar una VM o VPS
    - Ngrok
        - ngrok tcp 22
        - Actualizar fabfile con el puerto otorgado por ngrok
        
Configuración del host destino

    - Instalación de Docker / Docker-Compose
    - Ruta de despliegue configurada en fabfile.py
        - En dicha ruta haber realizado previamente "git init" para inicialiar repo
        - Configuración del .gti/config
        
Despliegue

    - Git push origin master 
    - Arranca los servicios de docker en la máquina destino
        - docker exec -it app_prod bash
        - Las variables de la aplicación están declaradas en el apartado // TODO y se injectan automáticatimante.  
            - Fabric usa para task arguments un tratamiento especial en los caracteres que hay que aplicar a las variables de entorno 

Comandos

    - docker ps
        Mostrará tres servicios levantados (app / nginx / mysql)
        Para para los contenedores y eliminar volumenes docker-compose -f docker-compose-prod.yml down (-v)
        