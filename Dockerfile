# --- Stage 1: Build Assets ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: PHP Application (Debian Bookworm) ---
FROM dunglas/frankenphp:1.3-php8.4-bookworm

# Install system dependencies (using apt-get for Debian)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    bash \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Laravel extensions
RUN install-php-extensions pdo_pgsql intl zip bcmath gd pcntl opcache

WORKDIR /var/www
COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod +x /usr/local/bin/frankenphp

# Render-specific environment
ENV PORT=10000
ENV SERVER_NAME=":10000"
EXPOSE 10000

# BYPASS THE ENTRYPOINT: This is the magic fix for Status 126
# We call the binary directly instead of letting the default script run
ENTRYPOINT ["/usr/local/bin/frankenphp", "php-server", "--listen", ":10000", "--root", "public/"]