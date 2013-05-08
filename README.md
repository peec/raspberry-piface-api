[![Build Status](https://travis-ci.org/peec/raspberry-piface-api.png?branch=master)](https://travis-ci.org/peec/raspberry-piface-api)

# Raspberry PI - PiFace API for PHP 5.4+

I ported the [original Python library](https://github.com/piface/pifacedigitalio) to PHP. This library works almost the same as the python library.


	Warning, not tested, i don't own the PiFace just yet, i am waiting for my PiFace to arrive :)
	Converted from Python to PHP.



## Requirements

- Hardware: Raspberry PI and PiFace module.
- PHP 5.4+ installed
- You also need to add the php SPI extension, compile it and configure, see: https://github.com/frak/php_spi
- Apache if you want to run commands from web scripts.


## Setting up the environment

Few things you need to install your environment, here is some instructions.

```bash
# Install php + git
sudo apt-get install php5 php5-dev git

# Install php SPI
git clone git://github.com/frak/php_spi.git ~/php_spi
cd ~/php_spi
./configure --enable-spi
make
make test
sudo make install

```

## Install

Install with Composer:

Here is some commands to your new project in `~/myphpiface` (in your home directory):

```bash
mkdir ~/myphppiface
touch ~/myphpiface/composer.json
echo '{ "require": { "pkj/raspberry-piface-api": "dev-master" } }' >> ~/myphpiface/composer.json
curl -sS https://getcomposer.org/installer | php
php composer.phar install
```

This will create a `vendor` directory where the library is installed.




## Usage:


Create a PHP script named `test_piface.php` (We assume that you place `test_piface.php` where `composer.json` file is.) and paste this in the file: 

```php
use Pkj\Raspberry\PiFace\PiFaceDigital;

dl("spi.so"); // Load the SPI extension.
require 'vendor/autoload.php';

$dev = PiFaceDigital::create();
// Run once.
$dev->init();

$dev->getLeds()[0]->turnOn();
sleep(2);
$dev->getLeds()[0]->turnOff();


// $dev->getInputPins();
// $dev->getOutputPins();
// $dev->getLeds();
// $dev->getRelays();
// $dev->getSwitches();


// Turn on relay 0
$dev->getRelays()[0]->turnOn();

// Get 0/1 of input pin 3 (There are 8 pins, 0-7)
$dev->getInputPins()[3]->getValue();

// Toggle a value on a output pin (5 in this example)
$dev->getOutputPins()[5]->toggle(); // 0
$dev->getOutputPins()[5]->toggle(); // 1
$dev->getOutputPins()[5]->toggle(); // 0





```

And test:

```bash
php -f test_piface.php
```





