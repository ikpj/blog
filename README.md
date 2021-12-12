# Basic Blog

## Contents

- [Features](#Features)
- [Environment](#environment)
- [Installation](#installation)
- [Database seeding](#database seeding)
- [URL](#url)
- [Credentials](#credentials)
- [Testing](#testing)
- [Deploy](#deploy)
- [Additional information](#Additional information)

## Features

+ User
    + Login
    + Registration
    + Create / Modify / Delete own Blog Posts
+ Admin
    + Login
    + Modify / Delete / Restore Blog Posts
    + Register / Modify / Delete / Restore Users
    + (Super Admin only) Register / Modify / Delete / Restore Admins
    + Update own admin info
+ Blog Display
    + List
    + Details

## Environment

+ PHP 8.0+
+ Laravel 8
+ Mysql or MariaDB

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/deployment#server-requirements)

Clone the repository

```
git clone https://github.com/ikpj/blog.git
```

Switch to the repo folder

```
cd blog
```

Install all the dependencies using composer

```
composer install
```

Copy the example env file and make the required configuration changes in the .env file

```
cp .env.example .env
```

Generate a new application key

```
php artisan key:generate
```

Set the environment config and database connection in .env before migrating. You need to configure the following configs according to your environment.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

Run the database migrations

```
php artisan migrate
```

## Database seeding

You should execute the `db:seed` after you complete the database migrations on any environment. For production, you will get 2 admin accounts(One super and one basic admin). For other environment(local, staging), you will get 25 admins, 25 users and 25 posts.

```
php artisan db:seed
```

## URL

Blog: http://domain / https://domain

Admin panel: http://domain/admin / https://domain/admin

Other links are displayed on site

## Credentials

User
```
Email: user@user.com
Password: password
```

Super Admin
```
Email: super@admin.com
Password: password
```

Basic Admin
```
Email: base@admin.com
Password: password
```

## Testing

```
composer test
```

## Deploy

Please check the official laravel deployment guide. [Official Documentation](https://laravel.com/docs/8.x/deployment)

Also, make sure to change default Super Admin and Basic Admin password by login to Super Admin to update own password and modify Base admin password.

Use Https is highly recommended.

## Additional information

+ Whole system is using soft delete.

+ All post with deleted user will also be displayed and author will show as `Deleted user`.

+ All deleted post will also be displayed if logged as admin

+ Super Admin can see the list of and create, update, destroy, restore admins, but Basic Admin can not except see the admin list.

+ Admin can see all record include soft deleted records with delete line at admin panel.

+ jeroennoten/laravel-adminlte is used for admin panel
