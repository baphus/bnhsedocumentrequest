# --- Stage 1: Build Assets ---
FROM node:20-alpine AS assets-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# --- Stage 2: PHP Application ---
FROM php:8.4-fpm-bookworm

# Install system dependencies
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

# Configure GD
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
RUN chmod -R 775 storage bootstrap/cache

# Nginx configuration (Hardcoded 3000 is used as a placeholder)
RUN rm -f /etc/nginx/sites-enabled/default
RUN echo 'server { \n\
    listen 3000; \n\
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
}' > /etc/nginx/conf.d/app.conf

# Supervisor configuration
RUN echo '[supervisord] \n\
nodaemon=true \n\
\n\
[program:php-fpm] \n\
command=php-fpm \n\
autostart=true \n\
autorestart=true \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0 \n\
\n\
[program:nginx] \n\
command=nginx -g "daemon off;" \n\
autostart=true \n\
autorestart=true \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0 \n\
\n\
[program:worker] \n\
command=php /var/www/artisan queue:work --tries=3 --timeout=90 \n\
autostart=true \n\
autorestart=true \n\
stopwaitsecs=3600 \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0' > /etc/supervisor/conf.d/supervisord.conf

ENV PORT=3000
EXPOSE 3000

# --- FIX: Custom Entrypoint Script ---
# Create a script that updates the Nginx port at runtime and starts Supervisor
RUN echo '#!/bin/sh \n\
# Replace "listen 3000" with "listen $PORT" in Nginx config \n\
sed -i "s/listen 3000;/listen ${PORT:-3000};/g" /etc/nginx/conf.d/app.conf \n\
\n\
# Start Supervisor \n\
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf \n\
' > /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container

# Use the new script as the command
CMD ["/usr/local/bin/start-container"]