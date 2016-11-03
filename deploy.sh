
## Install Composer
if ! command -v composer >/dev/null; then
	curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
fi

## Install WP-CLI
if ! command -v wp >/dev/null; then
	sudo curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
	sudo chmod +x wp-cli.phar
	sudo mv wp-cli.phar /usr/local/bin/wp
fi

## Install NodeJS
if ! command -v npm >/dev/null; then
	curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
	sudo apt-get install -y nodejs
	sudo apt-get install -y build-essential
fi

## Install Gulp
if ! command -v gulp >/dev/null; then
	sudo npm install --global gulp-cli
fi

## WP Keys
if [ ! -d "wp-keys.php" ]; then
	echo '<?php' $(wget https://api.wordpress.org/secret-key/1.1/salt/ -q -O -) > wp-keys.php
fi

## Composer dependencies
if [ -d "vendor" ]; then
	composer install
else
	composer update
fi

## WP Core
if [ -d "public/core" ]; then
	wp core update
else
	wp core download
fi

## Install NPM dependecies
if [ -d "node_modules" ]; then
	npm update
else
	npm install
fi

## Migrations
php migration.php

## Build assets
gulp build
