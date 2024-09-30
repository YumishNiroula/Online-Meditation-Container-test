# Use FrankenPHP as the base image
FROM dunglas/frankenphp

# Set the server name
ENV SERVER_NAME=localhost

# Enable PHP production settings
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Install system dependencies required by Laravel
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /app

# Copy the Laravel project files to the container
COPY . /app

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Set proper permissions for Laravel storage and cache folders
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache

# Expose the port FrankenPHP will listen on
EXPOSE 80

# Copy the Caddyfile to the container to configure FrankenPHP
COPY Caddyfile /etc/caddy/Caddyfile

# Start FrankenPHP directly (without --config)
CMD ["frankenphp"]
