<?php
namespace Pkj\Raspberry\PiFace\SpiManager;

/**
 * Standard SPI interface to implement.
 * @author peec
 *
 */
interface SpiInterface {
	
	
	/**
	 * Should open a SPI in dev.
	 * @param int $bus The bus
	 * @param int $chipselect What chip.
	 * @param array $options
	 */
	public function __construct($bus, $chipselect, array $options = array());
	
	/**
	 * Transfers array of data.
	 * Should return the result.
	 * @param array $data
	 */
	public function transfer(array $data);
	

	/**
	 * Should transfer a block stream of data.
	 * @param array $data
	 * @param unknown_type $colDelay
	 * @param unknown_type $disregard
	 */
	public function blockTransfer(array $data, $colDelay = 1, $disregard = false);
	
	
	
}