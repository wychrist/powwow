<?php

echo "copying .env.example to .env\n";
exec('cp .env.example .env');
echo "Running composer install\n";
exec('composer install');
echo "Generating key\n";
exec('php artisan key:generate');
echo "Creating database\n";

$pdo = new PDO('mysql:host=db', 'root', 'dbpassword');
$pdo->exec('create database placeholder');

echo "Run migration\n";
exec('php artisan migrate');
