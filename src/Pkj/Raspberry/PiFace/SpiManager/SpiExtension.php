<?php
namespace Pkj\Raspberry\PiFace\SpiManager;

/**
 * SpiExtension wrapper.
 * 
 * @author peec
 *
 */
class SpiExtension implements SpiInterface {

	private $spi;
	
	
	public function __construct($bus, $chipselect, array $options = array()) {
		$this->spi = new \Spi($bus, $chipselect, $options);
	}
	
	public function transfer(array $data) {
		return $this->spi->transfer($data);
	}
	
	
	public function blockTransfer(array $data, $colDelay = 1, $disregard = false) {
		return $this->spi->blockTransfer($data, $colDelay, $disregard);
	}
	
	
}