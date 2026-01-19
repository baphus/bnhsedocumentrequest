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
    curl \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Configure GD with support for multiple image formats
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql intl zip bcmath gd pcntl opcache

# Optimize PHP-FPM for Render (assuming 512MB RAM limit)
RUN echo "max_execution_time=60" > /usr/local/etc/php/conf.d/custom.ini \
    && echo "memory_limit=256M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "upload_max_filesize=64M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "post_max_size=64M" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.validate_timestamps=0" >> /usr/local/etc/php/conf.d/custom.ini \
    && echo "opcache.save_comments=1" >> /usr/local/etc/php/conf.d/custom.ini

# Tune PHP-FPM Pool
RUN echo "[www] \n\
pm = dynamic \n\
pm.max_children = 5 \n\
pm.start_servers = 2 \n\
pm.min_spare_servers = 1 \n\
pm.max_spare_servers = 3 \n\
" > /usr/local/etc/php-fpm.d/zz-custom.conf

WORKDIR /var/www

COPY . .
COPY --from=assets-builder /app/public/build ./public/build

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN mkdir -p database && touch database/database.sqlite
RUN composer install --no-dev --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod +x docker/keep-alive.sh

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
        fastcgi_read_timeout 300; \n\
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
\n\
[program:nginx] \n\
command=nginx -g "daemon off;" \n\
autostart=true \n\
autorestart=true \n\
\n\
[program:keep-alive] \n\
command=/var/www/docker/keep-alive.sh \n\
autostart=true \n\
autorestart=true \n\
stdout_logfile=/dev/stdout \n\
stdout_logfile_maxbytes=0 \n\
stderr_logfile=/dev/stderr \n\
stderr_logfile_maxbytes=0' > /etc/supervisor/conf.d/supervisord.conf


ENV PORT=10000
EXPOSE 10000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]