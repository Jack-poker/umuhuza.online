FROM dunglas/frankenphp

# ---- 1. Install PHP extensions (this is the fix for pdo_mysql) ----
RUN install-php-extensions \
    pdo_mysql \
    pdo_sqlite \
    mysqli \
    opcache \
    intl \
    zip \
    gd \
    bcmath \
    exif

# ---- 2. System deps (optional, safe to keep) ----
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libzip-dev \
    && rm -rf /var/lib/apt/lists/*

# ---- 3. Composer ----
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---- 4. App code ----
WORKDIR /app
COPY . /app

# ---- 5. Composer deps (production) ----
RUN composer install \
    --no-dev \
    --no-interaction \
    --no-progress \
    --optimize-autoloader \
    --prefer-dist

# ---- 6. Permissions ----
RUN chown -R www-data:www-data /app \
    && chmod -R 755 /app/public || true

# ---- 7. FrankenPHP env ----
ENV SERVER_NAME=:80
ENV APP_ENV=production

EXPOSE 80 443

# Default CMD from base image is fine; it starts FrankenPHP
