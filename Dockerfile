FROM php:8.1.0-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# Install system dependencies
RUN apt-get update  \
&&  apt-get install -y \
        git \
        curl \
        libzip-dev \
        zlib1g-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        vim \
        libcurl4-openssl-dev \
&&  docker-php-ext-install zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd curl

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions http

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN mkdir -p /usr/share/elasticsearch/data/nodes && \
    chown -R $user:$user /usr/share/elasticsearch/data/nodes && \
    chmod 777 -R /usr/share/elasticsearch/data/nodes

# Set working directory
WORKDIR /var/www

USER $user
