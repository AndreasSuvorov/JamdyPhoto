# Step 1: Use a lightweight base image
FROM php:8.3-fpm-alpine as base

# Step 2: Install system dependencies
RUN apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    zip \
    libzip-dev \
    git \
    curl

# Step 3: Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Step 4: Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Step 5: Set the working directory
WORKDIR /var/www

# Step 6: Copy the application code
COPY . .

# Step 7: Install Composer dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Step 8: Set up proper file permissions
RUN chown -R www-data:www-data /var/www

# Step 9: Expose the necessary ports
EXPOSE 9000

# Step 10: Start the PHP-FPM service
CMD ["php-fpm"]
