## Placeholder

Placeholder is the public facing website for your organisation or Church.

## Developing setup
 - Make sure your docker environment is up and running `docker-compose up -d`
 - ssh into the database container: `docker-compose exec db bash`
 - login to mariadb: `mysql -uroot -p[your root password default is dbpassword]`
 - create a database call **placeholder**: `create database placeholder;`
 - ssh into the php container: `docker-compose exec phpfpm bash`
 - cd into the placeholder folder: `cd placeholder`
 - cp .env.example to .env: `cp .env.example .env`
 - run composer install or update: `composer install` or `composer upgrade`
 - generate secret key: `php artisan key:generate`
 - migrate your database: `php artisan migrate`
 - seed the database: `php artisan db:seed`
 - run the following code
   ```bash
   mkdir ./storage/app
   ln -s /backend/placeholder/dummy_content /backend/placeholder/storage/app/content
   ```
 - exit the php container and ssh into **nodejs** container: `docker-compose exec nodejs bash`
 - cd into the placeholder folder: `cd projects/placeholder`
 - run yarn: `yarn`
