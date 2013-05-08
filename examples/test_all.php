<?php 
/**
 * This file tests visible components on your PiFace.
 * It will test Relays and Leds
 */
use Pkj\Raspberry\PiFace\PiFaceCommon;

use Pkj\Raspberry\PiFace\PiFaceDigital;
require __DIR__ . '/vendor/autoload.php';


// Init anew PiFaceDigital object. Note that Spi extension must be compiled and added!

if (!class_exists('\Spi')) {
	die ("Spi extension must be installed (https://github.com/frak/php_spi)");
}

$dev = PiFaceDigital::create();

// Run once.
$dev->init();


// Test relays

foreach ($this->getRelays() as $relay) {
	echo "Turning on relay: $relay\n";
	$relay->turnOn();
	sleep(1);
	echo "Turning off relay: $relay\n";
	$relay->turnOff();
	sleep(1);
}

// Test leds

foreach($this->getLeds() as $led) {
	echo "Turning on led: $led\n";
	$relay->turnOn();
	sleep(1);
	echo "Turning off led: $led\n";
	$relay->turnOff();
	sleep(1);
}



