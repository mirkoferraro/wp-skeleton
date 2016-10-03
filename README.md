# [WpSkeleton](https://github.com/mirkoferraro/wp-skeleton)

WpSkeleton is a starter kit for WordPress that helps you with the development of your site.

This project is the result of more than one year of high-level work with WordPress.

## Features

* Better folder structure
* Dependency management with Composer (also plugins) and NPM
* Support for WP-CLI
* Easy vm build with Vagrant

## Requirements

* PHP >= 5.6
* Composer
* NPM
* Gulp
* WP-CLI

## Installation

Use ```sh deploy.sh``` command to install:

* Composer (if not installed yet)
* wp-cli (if not installed yet)
* NodeJs (if not installed yet)
* Gulp (if not installed yet)
* WordPress
* WP Secret Keys
* NPM dependencies
* Composer dependencies
* Execute migration scripts
* Launch the build task of Gulp


## WP Secret Keys
The standard WP's secret keys are moved to wp-keys.php file.

```php
<?php
define('AUTH_KEY', '');
define('SECURE_AUTH_KEY', '');
define('LOGGED_IN_KEY', '');
define('NONCE_KEY', '');
define('AUTH_SALT', '');
define('SECURE_AUTH_SALT', '');
define('LOGGED_IN_SALT', '');
define('NONCE_SALT', '');
```
The deploy script create the wp-keys.php file for you by using the generated keys from [https://api.wordpress.org/secret-key/1.1/salt](https://api.wordpress.org/secret-key/1.1/salt/).


## Migrations
If you have to do some version migration on your WP site (generally on the database side), you can use the migrations system.

Create a php file in the **migrations** folder, name it using a date-time pattern (yyyymmddhhmm.php) in order to keep the migration files ordered. In your script you can use all the WP functions you need.

Launch the migration.php file from the terminal: ```php migration.php```


## Development with Vagrant

Open the Vagrantfile and edit ```skeleton``` in the first line (```HOSTNAME = "skeleton.vagrant.test"```). This will be your local server name for development purpose.

Use ```vagrant up``` command to open the Vagrant VM. The first time you run this command it create a virtual machine with Apache 2, PHP 7 and MySql 5.6.

Now you can view your site at ```yoursite.vagrant.test```.

You can found the Apache and PHP log files into the *log* folder into your project directory.

## Gulp tasks

Use ```gulp``` (default task) on your development machine in order to compile all the main tasks (svg, img, js, css and watch).

Use ```gulp build``` on your production server (svg, img, favicon, js, css and version).
