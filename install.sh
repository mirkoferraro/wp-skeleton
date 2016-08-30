## Install WP
wp core download

## Install WordPress Secret Keys
echo '<?php' $(wget https://api.wordpress.org/secret-key/1.1/salt/ -q -O -) > /var/www/wp-keys.php

## Install NPM dependecies
npm install

## Install Composer dependencies
composer install

## Build assets
gulp build