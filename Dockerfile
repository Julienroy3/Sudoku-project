FROM php:7-apache
 
# Install PDO MySQL driver
# See https://github.com/docker-library/php/issues/62
RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update -y && apt-get install -y libpng-dev
 
# Workaround for write permission on write to MacOS X volumes
# See https://github.com/boot2docker/boot2docker/pull/534
RUN usermod -u 1000 www-data
 
# Enable Apache mod_rewrite
RUN a2enmod rewrite


RUN apt-get update && apt-get install -y php5-mysql
