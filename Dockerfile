FROM php:8.2-fpm-alpine

# PDO MySQL driver (required by app/models) + nginx (replaces Apache;
# there is no official php:apache image on Alpine)
RUN docker-php-ext-install pdo_mysql \
    && apk add --no-cache nginx

# nginx server config: front-controller routing that replaces public/.htaccess
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Keep container env vars visible to PHP (php-fpm clears env by default)
COPY docker/zz-fpm.conf /usr/local/etc/php-fpm.d/zz-fpm.conf

# App lives at the web root; it is served from the public/ front controller
# (ROOT defaults to http://localhost/public, overridable via PUBLIC_ROOT)
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

# Run php-fpm (background) + nginx (foreground) in one container
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 80
CMD ["/usr/local/bin/entrypoint.sh"]
