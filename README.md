<p align="center"><a href="https://www.producthunt.com/posts/wave-2-0" target="_blank"><img src="https://resoftware.es/wp-content/uploads/reSoftware-S.L.-Facebook-Cover-New.png" height="auto" width="auto"></a></p>

## Introduction

**Connect, Play, Earn - re:Play Your Way to Social Gaming Glory!**

Welcome to [re:Play](https://play.resoftware.es), the ultimate social gaming platform
that brings friends and players together like never before! Step into a vibrant world
where gaming meets social interaction, and embark on thrilling adventures that transcend
traditional boundaries.

With re:Play, you can connect with friends, old and new, from all corners of the globe,
and experience the joy of playing together in real-time. Explore a vast array of games
catering to all tastes and skill levels, whether you're a casual gamer or a seasoned pro.

Compete in challenges, form teams, and celebrate victories together as you unlock
achievements and rise through the ranks. Join the social gaming revolution and let
**re:Play** redefine the way you play, connect, and experience the joys of gaming.

### Features

[re:Play](https://play.resoftware.es) uses a Software as a Service Starter Kit based on [Wave](https://devdojo.com/wave). It is built with [Laravel](https://laravel.com), [Voyager](https://voyager.devdojo.com), [TailwindCSS](https://tailwindcss.com), and a few other awesome technologies. Here are some of the awesome features ✨:

 - [Authentication](https://play.resoftware.es/docs/features/authentication)
 - [User Profiles](https://play.resoftware.es/docs/features/user-profiles)
 - [User Impersonation](https://play.resoftware.es/docs/features/user-impersonation)
 - [Subscriptions](https://play.resoftware.es/docs/features/billing)
 - [Subscription Plans](https://play.resoftware.es/docs/features/subscription-plans)
 - [User Roles](https://play.resoftware.es/docs/features/user-roles)
 - [Notifications](https://play.resoftware.es/docs/features/notifications)
 - [Announcements](https://play.resoftware.es/docs/features/announcements)
 - [Fully Functional Blog](https://play.resoftware.es/docs/features/blog)
 - [Out of the Box API](https://play.resoftware.es/docs/features/api)
 - [Voyager Admin](https://play.resoftware.es/docs/features/admin)
 - [Customizable Themes](https://play.resoftware.es/docs/features/themes)

## Demo

View a live [demo here](https://play.resoftware.es), or deploy your own instance to DigitalOcean, by clicking the button below.

<a href="https://cloud.digitalocean.com/apps/new?repo=https://github.com/resoftware-org/demo.resoftware.es/tree/main" target="_blank"><img src="https://www.deploytodo.com/do-btn-blue.svg" width="240" alt="Deploy to DigitalOcean"></a>

## Installation

To install this software, you'll want to clone or download this repo:

```
git clone https://github.com/resoftware-org/demo.resoftware.es.git project_name
```

Next, we can install re:Software with these **4 simple steps**:

### 1. Create a New Database

We'll need to utilize a MySQL database during the installation. For the following stage, you'll need to create a new database and preserve the credentials.

```sql
CREATE DATABASE wave;
CREATE USER 'wave'@'localhost' IDENTIFIED BY 'wave_password';
GRANT ALL PRIVILEGES ON wave.* TO 'wave'@'localhost';
```

### 2. Copy the `.env.example` file

We need to specify our Environment variables for our application. You will see a file named `.env.example`, you will need to duplicate that file and rename it to `.env`.

Then, open up the `.env` file and update your *DB_DATABASE*, *DB_USERNAME*, and *DB_PASSWORD* in the appropriate fields. You will also want to update the *APP_URL* to the URL of your application.

```bash
APP_URL=http://wave.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wave
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Add Composer Dependencies

First, you should ensure that your web server has the required PHP extensions installed:

> [Laravel PHP Requirements](https://laravel.com/docs/9.x/deployment#server-requirements)

Following that, we'll need to install all composer dependencies through the following command:
```php
composer install
```

### 4. Run Migrations and Seeds

We must migrate our database schema into our database, which we can accomplish by running the following command:
```php
php artisan migrate
```
<br>
Finally, we will need to seed our database with the following command:

```php
php artisan db:seed
```
<br>

🎉 And that's it! You will now be able to visit your URL and see your re:Software application up and running.

## Authentication

The backend can be accessed *only* using user accounts that are assigned the `admin`-role.

The **default admin credentials** are:

- Username: `support@resoftware.es`
- Password: `NotSoSecureAdminPassword`

Please, make sure to edit these *before* you deploy this software in production.

## Documentation

Checkout the [official documentation here](https://play.resoftware.es/docs).

## License

This software is released under the [MIT](./LICENSE) License.

Copyright © 2023-present re:Idea by re:Software SL (https://resoftware.es), All rights reserved.
Copyright © DevDojo (https://devdojo.com).


