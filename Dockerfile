# استخدم PHP مع FPM
FROM php:8.2-fpm

# إعداد مجلد العمل داخل الحاوية
WORKDIR /var/www

# تثبيت المتطلبات
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl

# تثبيت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# نسخ ملفات المشروع
COPY . /var/www

# تثبيت الحزم باستخدام Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# إعداد صلاحيات الملفات
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

# إعداد ملف البيئة في الإنتاج (تأكد أن لديك APP_KEY في .env أو تولده)
COPY .env.example .env
RUN php artisan key:generate

# فتح منفذ 8000 وتشغيل Laravel باستخدام php artisan serve
EXPOSE 8000

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
