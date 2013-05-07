# Raspberry PI - PiFace API for PHP 5.4+


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


