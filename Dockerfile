FROM php

COPY . /usr/src/blog
WORKDIR /usr/src/blog

# install tools
RUN apt-get -y update
RUN apt-get -y install git
RUN apt-get install zip unzip
RUN apt-get -y install libxml2-dev

# install PHP extenstions
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql

RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install xml

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# install app
RUN composer install -vvv
RUN npm install
RUN composer update
RUN npm run dev
RUN php artisan migrate

CMD php artisan serve --host 0.0.0.0

EXPOSE 8000