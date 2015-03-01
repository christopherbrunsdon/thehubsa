#!/bin/sh


# TODO: check if each phar exists before downloading
# TODO: check sushino settings

echo "Installing: PHPUNIT"
echo

wget https://phar.phpunit.de/phpunit.phar

chmod +x phpunit.phar

sudo mv phpunit.phar /usr/local/bin/phpunit

echo

echo "Installing: WP-CLI"
echo

curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

chmod +x wp-cli.phar

sudo mv wp-cli.phar /usr/local/bin/wp

echo
echo "Done"