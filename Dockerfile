FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg62-turbo-dev \
    libwebp-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    nginx \
    ghostscript \
    jpegoptim \
    optipng \
    pngquant \
    libmagickwand-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath zip \
    && pecl install imagick \
    && docker-php-ext-enable imagick

# Download and install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy all application files first
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install Node.js dependencies
RUN npm install

# Build frontend assets
RUN npm run build

# Create storage link
RUN php artisan storage:link

# Set permissions
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# Copy configuration files
COPY nginx.conf /etc/nginx/nginx.conf
COPY php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
COPY php.ini /usr/local/etc/php/conf.d/uploads.ini

# Create startup script
RUN echo '#!/bin/bash\n\
php artisan config:cache\n\
php artisan migrate --force\n\
php-fpm -D -y /usr/local/etc/php-fpm.conf\n\
nginx -g "daemon off;"' > /start.sh && chmod +x /start.sh

# Expose port
EXPOSE 8080

# Start application
CMD ["/start.sh"] 