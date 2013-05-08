[![Build Status](https://travis-ci.org/peec/raspberry-piface-api.png?branch=master)](https://travis-ci.org/peec/raspberry-piface-api)

# Raspberry PI - PiFace API for PHP 5.4+

	Warning, not tested, i don't own the PiFace just yet, i am waiting for my PiFace to arrive :)
	Converted from Python to PHP.


## Requirements

- You need to add the php SPI extension, compile it and configure, see: https://github.com/frak/php_spi


## Install

Install with composer.

## Usage:

```php
use Pkj\Raspberry\PiFace\PiFaceDigital;

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



```


