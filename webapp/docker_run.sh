#!/bin/bash
set -e

# Redirect logs to stdout and stderr
ln -sf /proc/$$/fd/1 /var/log/nginx/access.log
ln -sf /proc/$$/fd/2 /var/log/nginx/error.log

env >> /var/www/.env
php-fpm7.4 -D
nginx -g "daemon off;"
