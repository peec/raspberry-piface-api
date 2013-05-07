<?php
use Pkj\Raspberry\PiFace\PiFaceCommon;

use Pkj\Raspberry\PiFace\PiFaceDigital;

require __DIR__ . '/vendor/autoload.php';



$dev = new PiFaceDigital(new PiFaceCommon(new \Spi(0,0)));

$dev->getLeds()[0]->turnOn();

sleep(2);

$dev->getLeds()[0]->turnOff();
