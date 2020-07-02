FROM  php:7.4-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libmcrypt-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        git \
        curl \
        unzip \
        vim \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring zip exif pcntl

RUN mkdir /code

WORKDIR /code

ADD . /code/

RUN chmod +x reports/run_app_dev.sh reports/run_app_prod.sh

# -- instalamos composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && composer global require hirak/prestissimo --no-plugins --no-scripts

# Run composer to build dependencies in vendor folder
RUN cd reports && composer dump-autoload && composer install --no-dev --optimize-autoloader --classmap-authoritative

# Script que espera a que el puerto del contenedor esté operativo
# Docker por defecto:
#   1.- Docker-compose (depends-on) se ejecuta en cuanto el contenedor está UP, sin tener en cuenta que el servicio dentro de dicho container este UP también
#   2.- Para evitar que se ejecute el script de las migraciones en cuanto el contedor MSYQL está iniciado, este script espera a que realmente el puerto MYSQL haya iniciado.
COPY wait_for_it.sh /usr/bin/wait-for-it
RUN chmod +x /usr/bin/wait-for-it

# Varias maneras de pasar el script de migración:
# 1.- CMD , implica sobreescribir el CMD de la imagen FROM , por lo que después de ejecutar el script es necesario arrancar el servicio PHP-FPM
# 2.- Se puede evitar CMD y hacerlo posteriorme una vez iniciado todos los containers con docker-compose up
#   - Ejecutando el script contra el container una vez iniciado:  docker exec -it app_prod sh reports/run_app_prod.sh
#   - Esto se puede hacer en el fabfile después del docer-compose up
#       - PROBLEMA de dicha forma: Ya están todos iniciados y ejecutándose cuando se ejecuta el docker exec
CMD wait-for-it mysql:3306 -- sh reports/run_app_prod.sh ; php-fpm