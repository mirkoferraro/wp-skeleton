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

Use ```sh install.sh``` command to install:

* WordPress
* NPM dependencies
* Composer dependencies
* WP Secret Keys

## Development with Vagrant

Open the Vagrantfile and edit ```skeleton``` in the first line (```HOSTNAME = "skeleton.vagrant.test"```). This will be your local server name for development purpose.

Use ```vagrant up``` command to open the Vagrant VM. The first time you run this command it create a virtual machine with Apache 2, PHP 7 and MySql 5.6.

Now you can view your site at ```yoursite.vagrant.test```.

You can found the Apache and PHP log files into the *log* folder into your project directory.

## Gulp tasks

Use ```gulp``` (default task) on your development machine in order to compile all the main tasks (svg, img, js, css and watch).

Use ```gulp build``` on your production server (svg, img, favicon, js, css and version).