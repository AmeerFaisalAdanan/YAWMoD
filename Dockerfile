FROM php:8.2-fpm AS laravel-build

# install node js
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get install -y nodejs

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#setup composer globaly
RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc


COPY . /var/www
#RUN composer install && composer update
RUN npm install && npm run build
