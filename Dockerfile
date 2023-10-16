FROM php:latest

RUN apt-get update && \
    apt-get install -y --no-install-recommends less nano tini curl bash tar git zip unzip && \
    #echo "**** # To install networking tools for testing purpose ****" && \
    apt-get install -y --no-install-recommends iputils-ping dnsutils net-tools procps && \
    #echo "**** cleanup ****" && \
    apt-get autoremove -y && \
    apt-get clean -y

RUN apt-get update
RUN apt-get install -y --no-install-recommends libzip-dev libjpeg62-turbo-dev libpng-dev libfreetype6-dev

RUN docker-php-source extract
RUN docker-php-ext-install pdo_mysql zip exif pcntl gd
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install gettext && docker-php-ext-enable gettext
RUN docker-php-ext-install sockets && docker-php-ext-enable sockets

WORKDIR /var/www/html
COPY ./src ./
RUN chmod 755 *;
EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80"]
