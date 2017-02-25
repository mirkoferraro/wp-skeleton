# [WpSkeleton](https://github.com/mirkoferraro/wp-skeleton)

WpSkeleton is a starter kit for WordPress that helps you with the development of your site.

This project is the result of more than one year of high-level work with WordPress.


## Features

* Better folder structure
* Dependency management with Composer (also plugins) and NPM
* Support for WP-CLI


## Requirements

* PHP >= 5.6
* Composer
* NodeJs
* Gulp
* WP-CLI


## Installation

 * Use ```wp core download``` command to install WP core
 * Use ```npm install``` (or ```yarn``` if you prefer) command to install the node modules
 * Use ```composer install``` command to install the composer vendors


## Plugin installation
Plugins are manages by Composer, using the [WpPackagist](https://wpackagist.org/) repository.

If you want to install a plugin that isn't in the WpPackagist repository follow this instructions:
 * Copy the plugin' folder in the ```public/app/plugins``` directory
 * Edit the .gitignore file and add ```!public/app/plugins/{plugin-name}``` after ```public/app/plugins/*```
 
 ```!public/app/plugins/your-plugin-name```


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


## Database
Copy the *local-config.php.dist* to *local-config.php* and change the settings inside it.

Then you can use the WP-CLI to import the default database dump
```
wp db import db/dump.sql
```


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


## Theme functions
You can use ```view``` and ```component``` functions in order to print the templates contained in theme's ```views``` and ```components``` directory.


The ```view``` function use a hierarchical logic (like WP core) in order to print the right template based on the current main WP query.


The ```component``` function have no logic, simply print a template using the arguments passed to it.



## Private Files
You can use ```register_private_file``` function in order to manage authorized access to files.


For example the following code authorizes users that have capability ```read_myfiles``` (see [current_user_can()](https://codex.wordpress.org/Function_Reference/current_user_can) function) to access to URL like ```yoursite.com/myfiles/myimage.jpg``` and view the relative file stored in ```private/myfolder```.
```
register_private_file( 'myfiles', 'myfolder/', 'read_myfiles');
```


## Dates
Skeleton uses [Carbon](http://carbon.nesbot.com/) in PHP and [Moment](https://momentjs.com/) in Javascript for dates management.


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



## Cron Manager
Default WP crons are disabled in Skeleton, we suggest you to use the internal CronManager class in order to improve the efficency of your tasks.

First of all you should create a real cron using the command ```crontab -e``` and adding the following line:
```
*/5 * * * * php /path/to/project/cron.php
```

This will run the CronManager every 5 minutes.

Now you can create your own cron task in ```public/app/mu-plugins/skeleton/crons``` folder.
See the ```cron_example.php.dist```
