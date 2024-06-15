# install php 8.2, composer and node and git
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    nodejs \
    npm \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    && npm install -g npm@latest

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

#copy app to working directory
COPY . /var/www

#cd into the app directory
WORKDIR /var/www

# run npm run build
RUN npm install && npm run build

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]

#run migration and seeder
RUN php artisan migrate --seed