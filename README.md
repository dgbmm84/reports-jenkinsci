---
Depliegue usando github Actions/fabric usando un docker-compose PROD
---

GitHub Actions configuration
    
    - En el proyecto disponer de una carpeta en raiz .github/workflows donde irán los ymls
    - 2 workflows, uno para develop y otro para prod
    - Configuración del repositorio github Actions:
        -- En el repositorio /settings/secrets tenemos las variables necesarias y el SSH_KEY 

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
        - Las variables de la aplicación están declaradas en el apartado secrets /settings/secrets y se injectan automáticatimante.  
            - Fabric usa para task arguments un tratamiento especial en los caracteres que hay que aplicar a las variables de entorno 
                - En este caso para ENV_FILE_PROD (https://docs.fabfile.org/en/1.8/usage/fab.html#per-task-arguments)

Comandos

    - docker ps
        Mostrará tres servicios levantados (app / nginx / mysql)
        Para para los contenedores y eliminar volumenes docker-compose -f docker-compose-prod.yml down (-v)
        