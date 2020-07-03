---
Despliegue usando Jenkins Contra un Repositorio GitHub usando un docker-compose PROD
---

Configuration Jenkins

    Instalar Jenkins en la máquina o bajarse una instancia de docker con jenkins (Iniciaremos la 2ª opción)
        - docker run -it -p 8080:8080 -p 50000:50000 \
              -v jenkins_home:/var/jenkins_home \
              -v /var/run/docker.sock:/var/run/docker.sock \
              --restart unless-stopped \
              4oh4/jenkins-docker
              * Note: Exige tener docker en tu local corriendo ya que Jenkinsfile hace uso de docker 
        - Usage: https://github.com/jenkinsci/docker/blob/master/README.md 
             - http://localhost:8080/
            (-u 0 : Poder ejecutar comandos as sudo)
            
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
    Creación WebHook en el repositorio GitHub que lance un evento onPush contra jenkins
    Creación en Jenkins de un "FreeStyle project" dodne se configura Git con acceso Http al repositorio y que se ejecute en cada push.
    
    Importante: Para cualquier repositorio es necesario instalar los plugins correpondientes
    -------------------
    -------------------
    No lo haremos con webhooks ya que requiere de varios ngrok (de pago) uno para jenkins y otro para el VPS de despliegue.
    Lo que se hará es configurar en Jenkins 
        1.- pipeline haciendo uso de "Blue Ocean Integration Plugin" integración con GitHub
        2.- Volver a Dashboard jenkins http://localhost:8080/job/reports-jenkinsci/
        3.- Despues de cada push "scan repository now"
            - Atuomaticamente se pone en ejecución el pipeline
            - Entramos dentro de la rama master y vemos los stages del pipeline http://localhost:8080/job/reports-jenkinsci/job/master/
            
     
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
        