FROM php:7.4-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update -y

# Install system dependencies
RUN apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libonig-dev \
    libxml2-dev \
    openssl 

    # zip \
    # unzip \

RUN apt-get install -y \
  libmagickwand-dev \
  imagemagick \
  && pecl install \
  imagick \
  && docker-php-ext-enable \
  imagick 

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

RUN docker-php-ext-install mbstring exif pcntl bcmath

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# RUN apt-get -y install npm
# RUN npm install --global npm@7.7.4

# RUN npm install -g node@12

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
# COPY php.ini /usr/local/etc/php/

# Use the default development configuration:
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Add a custom configuration file:
COPY php.ini "$PHP_INI_DIR/conf.d/"

RUN apt install nano -y
# RUN apt install python3-certbot-apache -y

#RUN composer create-project --prefer-dist laravel/laravel=8.0 lace_graden

# สร้างและเชื่อมต่อ mysql->.env
# php artisan migrate
# composer require laravel/ui
# php artisan ui bootstrap --auth
# npm install && npm run dev
# chmod -R 777 storage

################################################
# RUN composer require laravel/breeze --dev
# php artisan breeze:install
# npm install OR npm install -g npm
# npm run dev

# chmod -R 777 storage

# RUN composer require laravel/ui
# RUN php artisan ui vue --auth

#EXPOSE 4000
