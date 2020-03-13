FROM php:7.2-apache-stretch

RUN apt update -qq

# install des packages dépédants
RUN apt install -y \
  git \
  curl \
  zip \
  unzip \
  build-essential \
  zlib1g-dev \
  libicu-dev \
  g++ \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libmcrypt-dev \
  libpng-dev \
  libxml2-dev \
  libgmp-dev \
  libssl-dev \
  libcurl4-openssl-dev \
  pkg-config

# install des mods php
RUN docker-php-ext-install -j$(nproc) \
  intl \
  gd \
  pdo \
  curl \
  json \
  gmp \
  mbstring \
  xml \
  zip \
  opcache

RUN docker-php-ext-configure \
    pdo_mysql

RUN docker-php-ext-install -j$(nproc) \
    pdo_mysql
    
RUN pecl install xdebug-2.6.0 \
  && docker-php-ext-enable xdebug

RUN docker-php-ext-configure intl && \
  docker-php-ext-install intl

RUN pecl install apcu \
  && docker-php-ext-enable apcu

# activation des mods apache
RUN a2enmod headers \
  rewrite \
  ssl

# Install Composer 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'c5b9b6d368201a9db6f74e2611495f369991b72d9c8cbd3ffbc63edff210eb73d46ffbfce88669ad33695ef77dc76976') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

# init php.ini
RUN mv $PHP_INI_DIR/php.ini-development $PHP_INI_DIR/php.ini

# config php.ini
RUN sed -i 's/memory_limit = 128MB/memory_limit = -1/' $PHP_INI_DIR/php.ini
RUN sed -i 's/opcache = 1/opcache = 1/' $PHP_INI_DIR/php.ini
RUN sed -i 's/opcache.memory_consumption/opcache.memory_consumption=256/' $PHP_INI_DIR/php.ini
RUN sed -i 's/opcache.max_accelerated_files/opcache.max_accelerated_files=20000/' $PHP_INI_DIR/php.ini
RUN sed -i 's/opcache.validate_timestamps/opcache.validate_timestamps=0/' $PHP_INI_DIR/php.ini

# Set locales
RUN apt install -y locales
RUN echo "en_US.UTF-8 UTF-8" >> /etc/locale.gen
RUN echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen 
RUN echo "en_GB.UTF-8 UTF-8" >> /etc/locale.gen
RUN echo "it_IT.UTF-8 UTF-8" >> /etc/locale.gen

#mise en place du vhosts
COPY ./vhost/api.symfony.conf /etc/apache2/sites-enabled/api.symfony.conf