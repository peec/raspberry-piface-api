<?php
namespace Pkj\Raspberry\PiFace;

/**
 * Provides common I/O methods for interfacing with PiFace Products
 * Converted from python to php
 * 
 * Original python project:
 * https://github.com/piface/pifacecommon
 *
 */

use Pkj\Raspberry\PiFace\SpiManager\SpiInterface;

class PiFaceCommon {
	
	/**
	 * Constants from pifacecommon.py.
	 */
	const 
	WRITE_CMD = 0,
	READ_CMD = 1,
	
	// Register addresses
	IODIRA = 0x0,  // I/O direction A
	IODIRB = 0x1,  // I/O direction B
	IPOLA = 0x2,  // I/O polarity A
	IPOLB = 0x3,  // I/O polarity B
	GPINTENA = 0x4,  // interupt enable A
	GPINTENB = 0x5,  // interupt enable B
	DEFVALA = 0x6,  // register default value A (interupts)
	DEFVALB = 0x7,  // register default value B (interupts)
	INTCONA = 0x8,  // interupt control A
	INTCONB = 0x9,  // interupt control B
	IOCON = 0xA,  // I/O config (also 0xB)
	GPPUA = 0xC,  // port A pullups
	GPPUB = 0xD,  // port B pullups
	INTFA = 0xE,  // interupt flag A (where the interupt came from)
	INTFB = 0xF,  // interupt flag B
	INTCAPA = 0x10,  // interupt capture A (value at interupt is saved here)
	INTCAPB = 0x11,  // interupt capture B
	GPIOA = 0x12,  // port A
	GPIOB = 0x13,  // port B
	
	// I/O config
	BANK_OFF = 0x00,  // addressing mode
	BANK_ON = 0x80,
	INT_MIRROR_ON = 0x40,  // interupt mirror (INTa|INTb)
	INT_MIRROR_OFF = 0x00,
	SEQOP_OFF = 0x20,  // incrementing address pointer
	SEQOP_ON = 0x20,
	DISSLW_ON = 0x10,  // slew rate
	DISSLW_OFF = 0x00,
	HAEN_ON = 0x08,  // hardware addressing
	HAEN_OFF = 0x00,
	ODR_ON = 0x04,  // open drain for interupts
	ODR_OFF = 0x00,
	INTPOL_HIGH = 0x02,  // interupt polarity
	INTPOL_LOW = 0x00,
	
	SPI_IOC_MAGIC = 107,
	
	SPIDEV = '/dev/spidev';
	
	
	
	
	/**
	 * Spi Driver
	 * @var Pkj\Raspberry\PiFace\SpiManager\SpiInterface
	 */
	private $spi;
	
	public function __construct(SpiInterface $spi) {
		$this->spi = $spi;
	}
	
	
	/**
	 * Gets the SPI manager.
	 * @return Pkj\Raspberry\PiFace\SpiManger\SpiInterface
	 */
	public function getSpi () {
		return $this->spi;
	}
	
	
	/**
	 * Translates a pin num to pin bit mask. First pin is pin0.
	 */
	public function getBitMask ($bitNum) {
		if ($bitNum > 7 || $bitNum < 0) {
			throw new RangeError(sprintf("Specified bit num (%d) out of range (0-7).", $bitNum));
		}
		return 1 << ($bitNum);
	}
	
	/**
	 * Returns the lowest pin num from a given bit pattern
	 */
	public function getBitNum ($bitPattern) {
		$bitNum = 0; // Assume bit 0
		while ($bitPattern & 1 === 0) {
			$bitPattern = $bitPattern >> 1;
			$bitNum += 1;
			if ($bitNum > 7) {
				$bitNum = 0;
				break;
			}
		}
		return $bitNum;
	}
	
	
	/**
	 * Returns the bit specified from the address
	 * @param unknown_type $bitNum
	 * @param unknown_type $address
	 * @param unknown_type $boardNum
	 */
	public function readBit ($bitNum, $address, $boardNum = 0) {
		$value = $this->read($address, $boardNum);
		$bitMask = $this->getBitMask($bitNum);
		
		return $value & $bitMask ? 1 : 0;
	}
	
	/**
	 * Writes the value given to the bit specified
	 */
	public function writeBit ($value, $bitNum, $address, $boardNum) {
		$bitMask = $this->getBitMask($bitNum);
		$oldByte = $this->read($address, $boardNum);
		
		if ($value) {
			$newByte = $oldByte | $bitMask;
		} else {
			$newByte = $oldByte & ~$bitMask;
		}
		
		$this->write($newByte, $address, $boardNum);
	}
	
	
	/**
	 * Returns the device opcode (as a byte)
	 * @param unknown_type $boardNum
	 * @param unknown_type $readWriteCmd
	 */
	public function _getDeviceOpcode ($boardNum, $readWriteCmd) {
		$boardAddrPattern = ($boardNum << 1) & 0xE; //  0b0010, 3 -> 0b0110
		$rwCmdPattern = $readWriteCmd & 1; // make sure it's just 1 bit long
		
		return 0x40 | $boardAddrPattern | $rwCmdPattern;
	}
	
	public function read ($address, $boardNum = 0) {
		$devopcode = $this->_getDeviceOpcode($boardNum, self::READ_CMD);
		
		$packet = [$devopcode, $address, 0];
		
		list($op, $addr, $data) = $this->spi->transfer($packet);
			
		return $data;
	}
	
	/**
	 * Writes data to the address specified
	 * @param unknown_type $data
	 * @param unknown_type $address
	 * @param unknown_type $boardNum
	 */
	public function write ($data, $address, $boardNum = 0) {
		$devopcode = $this->_getDeviceOpcode($boardNum, self::WRITE_CMD);
		
		$packet = [$devopcode, $address, $data];
		
		return $this->spi->transfer($packet);
	}
	
	
	
	
}
