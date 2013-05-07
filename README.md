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

use Pkj\Raspberry\PiFace\PiFaceCommon;

$dev = new PiFaceDigital(new PiFaceCommon(new \Spi(0,1)));

$dev->getLeds()[0]->turnOn();
sleep(2);
$dev->getLeds()[0]->turnOff();



```


