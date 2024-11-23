FROM php:8.3-fpm

RUN apt -y install php8.3-{common,cli,gd,mysql,mbstring,bcmath,xml,fpm,curl,zip,pdo}

WORKDIR /var/www/backend/

CMD ["php-fpm"]