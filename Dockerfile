# --- Stage 1: Build Assets ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: PHP Application ---
FROM php:8.4-fpm-bookworm

# Install system dependencies (including GD requirements)
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    libicu-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    nginx \
    supervisor \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure GD with support for multiple image formats
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql intl zip bcmath gd pcntl opcache

WORKDIR /var/www

COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN mkdir -p database && touch database/database.sqlite
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Nginx configuration
RUN echo 'server { \n\
    listen 10000; \n\
    root /var/www/public; \n\
    index index.php; \n\
    location / { \n\
        try_files $uri $uri/ /index.php?$query_string; \n\
    } \n\
    location ~ \.php$ { \n\
        fastcgi_pass 127.0.0.1:9000; \n\
        fastcgi_index index.php; \n\
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \n\
        include fastcgi_params; \n\
    } \n\
}' > /etc/nginx/sites-available/default

# Supervisor configuration
RUN echo '[supervisord] \n\
nodaemon=true \n\
\n\
[program:php-fpm] \n\
command=php-fpm \n\
autostart=true \n\
autorestart=true \n\
stopsignal=QUIT \n\
stopwaitsecs=60 \n\
stopasgroup=true \n\
killasgroup=true \n\
\n\
[program:nginx] \n\
command=nginx -g "daemon off;" \n\
autostart=true \n\
autorestart=true \n\
\n\
[program:worker] \n\
command=php /var/www/artisan queue:work --verbose --tries=3 --timeout=120 \n\
autostart=true \n\
autorestart=true \n\
stopwaitsecs=3600 \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0' > /etc/supervisor/conf.d/supervisord.conf


# Copy the new entrypoint script and make it executable
COPY docker/prod-entrypoint.sh /usr/local/bin/prod-entrypoint.sh
RUN chmod +x /usr/local/bin/prod-entrypoint.sh

ENV PORT=10000
EXPOSE 10000

CMD ["/usr/local/bin/prod-entrypoint.sh"]