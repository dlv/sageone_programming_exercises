#!/bin/sh

# Server name

HOSTNAME="sageone"

sudo apt-get update

echo "Installing basic packages for development"
sudo apt-get -y install gcc build-essential autoconf dh-autoreconf git subversion unzip zip

sudo apt-get update

# MYSQL
echo "Configurando Mysql Server com senha padrão 'root'"
echo "mysql-server mysql-server/root_password password root" | sudo debconf-set-selections
echo "mysql-server mysql-server/root_password_again password root" | sudo debconf-set-selections
sudo apt-get -y install mysql-server

# MYSQL Rodando em todos os IP's
sudo sed -i 's/127\.0\.0\.1/0\.0\.0\.0/g' /etc/mysql/my.cnf
sudo service mysql start
# Permite conectar no mysql como root de outras máquinas
mysql -uroot --password=toor -e 'USE mysql; UPDATE `user` SET `Host`="%" WHERE `User`="root" AND `Host`="localhost"; DELETE FROM `user` WHERE `Host` != "%" AND `User`="root"; FLUSH PRIVILEGES;'

mysql -uroot --password=root -e 'CREATE DATABASE sageone;'

sudo service mysql restart

mysql -uroot --password=root portalav < database.sql

#APACHE
echo "Instalando o APACHE"
sudo apt-get -y install apache2

#PHP
echo "Instalando PHP"
sudo apt-get -y install php5 php5-dev php5-mysql libapache2-mod-php5 php5-mongo php5-curl php5-sqlite php5-xdebug php5-mysql

echo "Criando os virtual hosts"
sudo cp sageone.conf /etc/apache2/sites-available/sageone.conf

sudo rm -rf /etc/apache2/sites-enabled/*.conf
sudo rm -rf /var/www/*
sudo cp -R ../sageone /var/www/.

echo "Habilitando os virtual hosts"
sudo a2ensite sageone

echo "Habilitando Mod Rewrite no apache"
sudo a2enmod sageone

echo "Adicionando os alias para intranet e beta no hosts"
ip=$(ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}')
sudo sed -i "/127\.0\.0\.1\ localhost/ a\\$ip sageone.com" /etc/hosts

echo "Reiniciando o APACHE para aceitar as configurações"
sudo service apache2 restart

# Hostname
#echo "Setting hostname..."
#sudo hostname "sageone"

##### CLEAN UP #####
sudo dpkg --configure -a # when upgrade or install doesn't run well (e.g. loss of connection) this may resolve quite a few issues
sudo apt-get autoremove -y # remove obsolete packages
