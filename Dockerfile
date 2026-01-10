# --- Stage 1: Build Assets (Vite/NPM) ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: PHP Application (FrankenPHP Bookworm) ---
FROM dunglas/frankenphp:1.3-php8.4-bookworm

# 1. Install system dependencies (using apt-get for Debian)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    bash \
    libcap2-bin \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. Install PHP extensions (FrankenPHP comes with this helper)
RUN install-php-extensions \
    pdo_pgsql \
    intl \
    zip \
    bcmath \
    gd \
    pcntl \
    opcache

WORKDIR /var/www

# 3. Copy application files and assets
COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# 4. Install Composer dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5. Permissions Fixes for Render
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod +x /usr/local/bin/frankenphp

# Give FrankenPHP permission to bind to the port
RUN setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp

# 6. Final Setup
ENV PORT=10000
ENV SERVER_NAME=":10000"
EXPOSE 10000

# Use the full path and ensure we aren't overriding with an invalid dashboard command
CMD ["/usr/local/bin/frankenphp", "php-server", "--listen", ":10000", "--root", "public/"]