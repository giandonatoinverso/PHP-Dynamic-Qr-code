FROM php:7.4.21-apache
ARG APP_VERSION=v1.0.6

RUN apt-get update && \
    apt-get install -y --no-install-recommends less nano tini curl tar git zip unzip && \
    #echo "**** # To install networking tools for testing purpose ****" && \
    apt-get install -y --no-install-recommends iputils-ping dnsutils net-tools procps && \
    #echo "**** cleanup ****" && \
    apt-get autoremove -y && \
    apt-get clean -y

RUN curl -SL -o app.tar.gz "https://github.com/giandonatoinverso/PHP-Dynamic-Qr-code/archive/${APP_VERSION}.tar.gz"  \
    && mkdir -p /app \
    && tar xvf app.tar.gz -C /app --strip-components=1 \
    && cp -r /app/qrcode/** /var/www/html \
    && rm app.tar.gz

RUN apt-get update
RUN apt-get install -y --no-install-recommends libzip-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev

# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN rm composer-setup.php
RUN mv composer.phar /usr/local/bin/composer

# Install extensions
RUN docker-php-source extract
RUN docker-php-ext-install pdo_mysql zip exif pcntl gd
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install gettext && docker-php-ext-enable gettext
RUN docker-php-ext-install sockets && docker-php-ext-enable sockets

RUN mv "/usr/local/etc/php/php.ini-production" "/usr/local/etc/php/php.ini"

WORKDIR /var/www/html

COPY ./config/docker-entrypoint.sh /bin/docker-entrypoint.sh
RUN chmod +x /bin/docker-entrypoint.sh
COPY ./config/vhost.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

ENV APP_USER appuser
ARG PUID=1000
ARG PGID=1000
RUN groupadd -g ${PGID} $APP_USER \
    && useradd -M -u ${PUID} -g ${PGID} $APP_USER \
    && chown -R $APP_USER:$APP_USER /var/run/apache2 \
    && chown -R $APP_USER:$APP_USER /var/log \
    && chown -R $APP_USER:$APP_USER /etc/apache2 \
    && chown -R $APP_USER:$APP_USER /var/lib/apache2 \
    && chown -R $APP_USER:$APP_USER /var/www
USER $APP_USER
CMD apache2ctl -D FOREGROUND

EXPOSE 80

# needs to fix install process to create database and then below line can be commented out
#ENTRYPOINT ["/bin/docker-entrypoint.sh"]
