#!/bin/sh

cd /var/www

php artisan cache:clear
php artisan route:cache
php artisan migrate

/usr/bin/supervisord -c /etc/supervisord.conf
