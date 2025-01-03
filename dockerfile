FROM php:8.2-apache

# Install mysqli and other extensions
RUN docker-php-ext-install mysqli

# Optional: Enable any additional extensions
# RUN docker-php-ext-install pdo pdo_mysql

# Copy your application code
COPY . /var/www/html/
