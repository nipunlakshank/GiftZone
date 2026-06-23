#!/bin/sh
set -e

# php-fpm listens on 127.0.0.1:9000 (its default pool); nginx proxies to it.
php-fpm -D

# nginx in the foreground so it owns PID 1's lifecycle.
exec nginx -g 'daemon off;'
