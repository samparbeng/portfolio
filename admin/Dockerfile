# Use the official PHP image with Apache
FROM php:8.1-apache

# Install necessary system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  libzip-dev \
  unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install pdo_mysql gd mysqli zip 



# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy application source code to the container
COPY . .

# Expose the port Apache is listening on
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
