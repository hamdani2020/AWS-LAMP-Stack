# Use the official PHP-Apache image
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy project files to Apache root directory
COPY . /var/www/html/

# Set permissions for web files
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/

# Expose port 80 for Apache
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

