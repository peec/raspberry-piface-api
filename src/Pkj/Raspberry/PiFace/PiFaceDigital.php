<?php
namespace Pkj\Raspberry\PiFace;

use Pkj\Raspberry\PiFace\SpiManager\SpiExtension;

use Pkj\Raspberry\PiFace\Components as Component;


class PiFaceDigital {
	
	const 	OUTPUT_PORT = PiFaceCommon::GPIOA,
			INPUT_PORT = PiFaceCommon::GPIOB,
			INPUT_PULLUP = PiFaceCommon::GPPUB,
			MAX_BOARDS = 4;
	
	// /dev/spidev<bus>.<chipselect>
	const
			SPI_BUS = 0,
			SPI_CHIP_SELECT = 0;
	
	
	private $handler;
	
	
	private $boardNum;
	
	private $inputPins = array(),
			$outputPins = array(),
			$leds = array(),
			$relays = array(),
			$switches = array();
	
	
	/**
	 * Gets all the input pins.
	 * @return array Array of InputItem
	 */
	public function getInputPins () {
		return $this->inputPins;
	}
	
	/**
	 * Gets all the output pins.
	 * @return array Array of OutputItem
	 */
	public function getOutputPins () {
		return $this->outputPins;
	}
	
	/**
	 * Gets all the leds.
	 * @return array Array of LED
	 */
	public function getLeds () {
		return $this->leds;
	}
	
	/**
	 * Gets all the relays.
	 * @return array Array of Relay
	 */
	public function getRelays () {
		return $this->relays;
	}
	
	/**
	 * Gets all the switches.
	 * @return array Array of SwitchItem
	 */
	public function getSwitches () {
		return $this->switches;
	}
	
	public function getHandler () {
		return $this->handler;
	}
	
	static public function create () {
		$spi = new SpiExtension(self::SPI_BUS, self::SPI_CHIP_SELECT);
		$common = new PiFaceCommon($spi);
		return new PiFaceDigital($common);
	}
	
	/**
	 * Creates a new device.
	 * @param PiFaceCommon $handler A PiFaceCommon instance.
	 * @param int $boardNum Board number.
	 */
	public function __construct (PiFaceCommon $handler, $boardNum = 0) {
		$this->handler = $handler;
		
		$this->boardNum = $boardNum;
		
		// Ranges are +1 for pins.
		
		foreach (range(0, 7) as $pinNum) {
			$this->inputPins[] = new Component\InputItem($this->handler, ($pinNum), $this->boardNum);
		}
		
		foreach (range(0, 7) as $pinNum) {
			$this->outputPins[] = new Component\OutputItem($this->handler, ($pinNum), $this->boardNum);
		}
		
		foreach (range(0, 7) as $pinNum) {
			$this->leds[] = new Component\LED($this->handler, ($pinNum), $this->boardNum);
		}
		
		foreach (range(0, 1) as $pinNum) {
			$this->relays[] = new Component\Relay($this->handler, ($pinNum), $this->boardNum);
		}
		
		foreach (range(0, 3) as $pinNum) {
			$this->switches[] = new Component\SwitchItem($this->handler, ($pinNum), $this->boardNum);
		}
		
		
	}
	
	
	/**
	 * Initialises the PiFace Digital board
	 * @param unknown_type $initBoard
	 * @throws \Exception
	 */
	public function init ($initBoard = true) {
		
		if ($initBoard) {
			
			// Setup each board
			$ioconfig = PiFaceCommon::BANK_OFF | 
						PiFaceCommon::INT_MIRROR_OFF |
						PiFaceCommon::SEQOP_ON |
						PiFaceCommon::DISSLW_OFF |
						PiFaceCommon::HAEN_ON |
						PiFaceCommon::ODR_OFF |
						PiFaceCommon::INTPOL_LOW;
			
			$pfdDetected = false;
			
			foreach(range(0, self::MAX_BOARDS) as $boardIndex) {
				$this->handler->write($ioconfig, PiFaceCommon::IOCON, $boardIndex);
				
				if (!$pfdDetected) {
					if ($this->handler->read(PiFaceCommon::IOCON, $boardIndex) == $ioconfig) {
						$pfdDetected = true;
					}
				}
				
				$this->handler->write(0, PiFaceCommon::GPIOA, $boardIndex);
				$this->handler->write(0, PiFaceCommon::IODIRA, $boardIndex);
				$this->handler->write(0xff, PiFaceCommon::IODIRB, $boardIndex);
				$this->handler->write(0xff, PiFaceCommon::GPPUB, $boardIndex);
			}
			
			if (!$pfdDetected) {
				throw new \Exception ("No piface board detected.");
			}
			
		}
		
	}
	
	
	
	
	
	
}


