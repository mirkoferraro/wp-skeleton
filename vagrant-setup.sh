## Define new apt-get function in order to fix Vagrant terminal issue
function aptget {
  sudo DEBIAN_FRONTEND=noninteractive apt-get -y -o Dpkg::Options::="--force-confdef" -o Dpkg::Options::="--force-confold" $@
}

## Save mysql password for later use
echo "mysql-server mysql-server/root_password password root" | sudo debconf-set-selections
echo "mysql-server mysql-server/root_password_again password root" | sudo debconf-set-selections

## First update
aptget update
aptget install software-properties-common
aptget install python-software-properties

## Add ppa repositories
sudo add-apt-repository ppa:ondrej/apache2
sudo add-apt-repository ppa:ondrej/php
sudo add-apt-repository -y ppa:ondrej/mysql-5.6
aptget update
aptget upgrade

## Install Apache 2, PHP 7, MySQL 5.6 and other useful stuffs
aptget install -y vim
aptget install -y curl
aptget install -y sendmail
aptget install git
aptget install -y apache2
aptget install -y php7.0
aptget install -y libapache2-mod-php7.0
aptget install -y php7.0-curl
aptget install -y php7.0-gd
aptget install -y php7.0-mbstring
aptget install -y php7.0-mcrypt
aptget install -y php7.0-imap
aptget install -y php7.0-xml
aptget install -y php7.0-xdebug
aptget install -y mysql-server-5.6
aptget install -y php7.0-mysql

## Change default configurations
sudo a2enmod rewrite
sudo sed -i "s/IncludeOptional sites-enabled\/\*\.conf/IncludeOptional \/var\/www\/vagrant-vhost.conf/" /etc/apache2/apache2.conf
sudo sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/7.0/cli/php.ini
sudo sed -i "s/display_errors = .*/display_errors = On/" /etc/php/7.0/cli/php.ini
sudo sed -i "s/;error_log = php_errors.log/error_log = \/var\/www\/log\/php.log/" /etc/php/7.0/cli/php.ini
sudo sed -i "s/skip-external-locking/#skip-external-locking/" /etc/mysql/my.cnf
sudo sed -i "s/bind-address.*=.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf

cat << EOF | sudo tee -a /etc/php/7.0/mods-available/xdebug.ini
xdebug.scream=1
xdebug.cli_color=1
xdebug.show_local_vars=1
EOF

## Remove Apache2 main html folder
rm -r /var/www/html

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
