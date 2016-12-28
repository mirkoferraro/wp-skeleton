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


## Database
Copy the *local-config.php.dist* to *local-config.php* and change the settings inside it.

Then you can use the WP-CLI to import the default database dump
```
wp db import db/dump.sql
```


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
Skeleton try to generate it on first page loading, otherwise you can create your own file from [https://api.wordpress.org/secret-key/1.1/salt](https://api.wordpress.org/secret-key/1.1/salt/).


## Migrations
If you have to do some version migration on your WP site (generally on the database side), you can use the migrations system.

Create a php file in the **migrations** folder, name it using a date-time pattern (yyyymmddhhmm.php) in order to keep the migration files ordered. In your script you can use all the WP functions you need.

Launch the migration.php file from the terminal: ```php migration.php```


## Gulp tasks

Use ```gulp``` (default task) on your development machine in order to compile all the main tasks (svg, img, js, css and watch).

Use ```gulp build``` on your production server (svg, img, favicon, js, css and version).


## Administrator User
Create your administrator user:
```
wp user create yourusername your@email.com --role=administrator
```

Update the admin email as well:
```
wp option update admin_email your@email.com
```


## Private Files
You can use ```register_private_file``` function in order to manage authorized access to files.


For example the following code authorizes users that have capability ```read_myfiles``` (see [current_user_can()](https://codex.wordpress.org/Function_Reference/current_user_can) function) to access to URL like ```yoursite.com/myfiles/myimage.jpg``` and view the relative file stored in ```private/myfolder```.
```
register_private_file( 'myfiles', 'myfolder/', 'read_myfiles');
```


## Javascript integrations

### Event Wrappers
Javascript files are located in *public/assets/src/js/*. Including the event-wrapper.js into main.js allow you to use the ScrollWrapper and ResizeWrapper.

The ScrollWrapper is an instance of Throttler class, that run callbacks at most one time every 300 ms (this time value can be edited). The ResizeWrapper is an instance of Debouncer class, that runs callbacks only after 300 ms from the last event ping.

ScrollWrapper is binded to scroll event: the callbacks added to ScrollWrapper will be called every 300 ms during the scroll event.

ResizeWrapper is binded to resize event: the callbacks added to ResizeWrapper will be called after 300 ms from the last resize event.

In order to add a function to ScrollWrapper and ResizeWrapper use the *put* function:
```js
ScrollWrapper.put( 'animation_on_scroll', function() { ... } );
ResizeWrapper.put( 'animation_on_resize', function() { ... } );
```

To remove a function from the wrappers use the *remove* function:
```js
ScrollWrapper.remove( 'animation_on_scroll' );
ResizeWrapper.remove( 'animation_on_resize' );
```

### Google Maps Loader
You can use the *gmaps-loader.js* in order to manage several callbacks on the gmaps' *initMap* callback.
Instead of *initMap* use the *onMapLoaded* function to add your callbacks.
```js
onMapLoaded( function() { ... } );
```

All your callbacks will be called after the firing of the *initMap* function.
