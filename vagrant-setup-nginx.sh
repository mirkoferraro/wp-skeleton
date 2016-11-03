## Define new apt-get function in order to fix Vagrant terminal issue
function aptget {
  sudo DEBIAN_FRONTEND=noninteractive apt-get -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" $@
}

## Save mysql password for later use
echo "mysql-server mysql-server/root_password password 68tRW4gztScxc3h6" | sudo debconf-set-selections
echo "mysql-server mysql-server/root_password_again password 68tRW4gztScxc3h6" | sudo debconf-set-selections

## First update
aptget install software-properties-common
aptget install python-software-properties
# sudo add-apt-repository ppa:ondrej/php
aptget update
aptget upgrade

## Install Nginx, PHP 5.6, MySQL 5.6 and other useful stuffs
aptget install -y vim
aptget install -y curl
aptget install -y sendmail
aptget install git
aptget install -y nginx
aptget install -y mysql-server
aptget install -y php7.0
aptget install -y php7.0-fpm
aptget install -y php7.0-curl
aptget install -y php7.0-gd
aptget install -y php7.0-mcrypt
aptget install -y php7.0-imap
aptget install -y php7.0-cli
aptget install -y php7.0-xdebug
aptget install -y php7.0-mysql

aptget install -y php5-fpm
aptget install -y php5-curl
aptget install -y php5-gd
# aptget install -y php5-mbstring
aptget install -y php5-mcrypt
aptget install -y php5-imap
# aptget install -y php5-xml
aptget install -y php5-cli
aptget install -y php5-xdebug
aptget install -y php5-mysql


sudo sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.inic


sudo sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php5/fpm/php.ini
sudo sed -i "s/include \/etc\/nginx\/sites-enabled\/\*;/include \/var\/www\/vagrant-nginx;/" /etc/nginx/nginx.conf
# sudo sed -i "s/;listen.owner = www-data/listen.owner = www-data/" /etc/php5/fpm/pool.d/www.conf
# sudo sed -i "s/;listen.group = www-data/listen.group = www-data/" /etc/php5/fpm/pool.d/www.conf
# sudo sed -i "s/;listen.mode = 0660/listen.mode = 0660/" /etc/php5/fpm/pool.d/www.conf
sudo sed -i "s/skip-external-locking/#skip-external-locking/" /etc/mysql/my.cnf
sudo sed -i "s/bind-address.*=.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

cat << EOF | sudo tee -a /etc/php5/conf.d/xdebug.ini
cat << EOF | sudo tee -a /etc/php/7.0/fpm/conf.d/20-xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF

# Restart PHP5-FPM and Nginx
sudo service php5-fpm restart
sudo service nginx restart

## Create log folder
mkdir -p /var/www/log

## Import base MySQL DB
mysql --user=root --password=root -e "CREATE DATABASE skeleton; USE skeleton;"
mysql --user=root --password=root -h localhost skeleton < /var/www/db/dump.sql

## Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

## Install WP CLI
sudo curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
sudo chmod +x wp-cli.phar
sudo mv wp-cli.phar /usr/local/bin/wp

## Install NodeJs
curl -sL https://deb.nodesource.com/setup_6.x | sudo -E bash -
aptget install -y nodejs
aptget install -y build-essential

## Install Gulp
sudo npm install --global gulp-cli
