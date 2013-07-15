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

foreach ($dev->getRelays() as $relay) {
	echo "Turning on relay: $relay\n";
	$relay->turnOn();
	sleep(1);
	echo "Turning off relay: $relay\n";
	$relay->turnOff();
	sleep(1);
}

// Test leds

foreach($dev->getLeds() as $led) {
	echo "Turning on led: $led\n";
	$led->turnOn();
	sleep(1);
	echo "Turning off led: $led\n";
	$led->turnOff();
	sleep(1);
}

// Test inputs

foreach ($dev->getInputPins() as $inputPin) {
    echo "Value of $inputPin is {$inputPin->getValue()}\n";
}



