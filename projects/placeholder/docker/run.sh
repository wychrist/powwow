#!/bin/sh

if [ -f /var/www/deploy_scripts/pre.sh ]
then
    sh /var/www/deploy_scripts/pre.sh
fi

cd /var/www

php artisan cache:clear
php artisan migrate
php artisan route:cache
php artisan view:cache

if [ -f /var/www/deploy_scripts/post.sh ]
then
    sh /var/www/deploy_scripts/post.sh
fi

/usr/bin/supervisord -c /etc/supervisord.conf
