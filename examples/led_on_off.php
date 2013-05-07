<?php
use Pkj\Raspberry\PiFace\PiFaceCommon;

use Pkj\Raspberry\PiFace\PiFaceDigital;

require __DIR__ . '/vendor/autoload.php';


// Init anew PiFaceDigital object. Note that Spi extension must be compiled and added!
$dev = new PiFaceDigital(new PiFaceCommon(new \Spi(0,0)));

// Run once.
$dev->init();

// Turn on the first led.
$dev->getLeds()[0]->turnOn();

// Sleep for 2 sec.
sleep(2);

// Turn off the first led.
$dev->getLeds()[0]->turnOff();
