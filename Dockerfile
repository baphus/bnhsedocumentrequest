# --- Stage 1: Build Assets (Vite/NPM) ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: PHP Application (FrankenPHP) ---
FROM dunglas/frankenphp:1.3-php8.4-alpine

# Install necessary system libraries for Postgres and PHP extensions
RUN apk add --no-cache \
    libpq-dev \
    libzip-dev \
    icu-dev \
    bash

# Install PHP extensions required by Laravel 12
RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    bcmath \
    gd \
    pcntl \
    opcache

# Set Working Directory
WORKDIR /var/www

# Copy application files
COPY . .
# Copy built assets from Stage 1
COPY --from=assets-builder /app/public/build ./public/build

# Install Composer dependencies (Production mode)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Set permissions for Laravel storage and cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Render uses a dynamic $PORT, usually 10000
ENV PORT=10000
EXPOSE 10000

# Start FrankenPHP in "Worker Mode" for high performance
CMD ["frankenphp", "php-server", "--listen", ":10000", "--root", "public/"]