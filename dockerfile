# Gebruik PHP 8.1 met Apache
FROM php:8.1-apache

# Installeer benodigde extensies
RUN docker-php-ext-install pdo pdo_mysql

# Configureer Apache om de juiste map te gebruiken
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/cinema/' /etc/apache2/sites-available/000-default.conf

# Zet de werkmap
WORKDIR /var/www/html/cinema

# Kopieer alleen de cinema map
COPY cinema/ /var/www/html/cinema/

# Apache herschrijvingen aanzetten
RUN a2enmod rewrite

# Juiste rechten instellen
RUN chown -R www-data:www-data /var/www/html/cinema

# Poort openzetten
EXPOSE 80