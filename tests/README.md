# Testing

Table of contents


Reference:
----------

Wordpress automated testing:

https://make.wordpress.org/core/handbook/automated-testing/

https://pippinsplugins.com/unit-tests-wordpress-plugins-setting-up-testing-suite/

http://code.tutsplus.com/articles/the-beginners-guide-to-unit-testing-building-a-testable-plugin--wp-25741

http://wern-ancheta.com/blog/2013/09/29/unit-testing-wordpress-plugins/

Setting up:
-----------

**Installing phpunit**

Reference: https://phpunit.de/manual/4.5/en/installation.html

Add the following to the end of your `php.ini` or suhosin.ini  

$ sudo vi /etc/php5/cli/conf.d/suhosin.ini)

Edit the line : suhosin.executor.include.whitelist = phar


$ wget https://phar.phpunit.de/phpunit.phar

$ chmod +x phpunit.phar

$ sudo mv phpunit.phar /usr/local/bin/phpunit

$ phpunit --version

PHPUnit x.y.z by Sebastian Bergmann and contributors.


**Install WP CLI**

Reference: http://wp-cli.org/#install

$ curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

Then, check if it works:

$ php wp-cli.phar --info

To be able to type just wp, instead of php wp-cli.phar, you need to make the file executable and move it to somewhere in your PATH. For example:

$ chmod +x wp-cli.phar
$ sudo mv wp-cli.phar /usr/local/bin/wp

Now try running wp --info.

$wp --info

Upgrade using the same procedure.

**Setup**

$ sudo -u www-data -i -- wp scaffold plugin-tests restrict-content-pro --path='/var/www/html'

[eof]