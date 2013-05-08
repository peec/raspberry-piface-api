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


// Turn on relay 0
$dev->getRelays()[0]->turnOn();

// Get 0/1 of input pin 3 (There are 8 pins, 0-7)
$dev->getInputPins()[3]->getValue();

// Toggle a value on a output pin (5 in this example)
$dev->getOutputPins()[5]->toggle(); // 0
$dev->getOutputPins()[5]->toggle(); // 1
$dev->getOutputPins()[5]->toggle(); // 0





```


