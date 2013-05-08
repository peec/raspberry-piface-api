<?php
namespace Pkj\Raspberry\PiFace;

class PiFaceCommonTest extends \PHPUnit_Framework_TestCase {
	
	private function getInstance () {
		$spi = $this->getMock('Pkj\Raspberry\PiFace\SpiManager\SpiInterface');
		return new PiFaceCommon($spi);
	}
	
	
	public function testHasSpi () {
		$c = $this->getInstance();
		$this->assertInstanceOf('Pkj\Raspberry\PiFace\SpiManager\SpiInterface', $c->getSpi());	
	}
	
	
	public function testGetBitMask () {
		$c = $this->getInstance();
		$this->assertEquals(0x2, $c->getBitMask(1));
		$this->assertEquals(0x4, $c->getBitMask(2));
		$this->assertEquals(0x8, $c->getBitMask(3));
		$this->assertEquals(0x10, $c->getBitMask(4));
	}
	
	/**
	 * @expectedException Pkj\Raspberry\PiFace\RangeError
	 */
	public function testGetBitMaskException () {
		$c = $this->getInstance();
		$c->getBitMask(8);
	}
	
	
	public function testWrite () {
		$spi = $this->getMock('Pkj\Raspberry\PiFace\SpiManager\FileSpiManager', array('transfer'), array(0,0));
		
		$c = new PiFaceCommon($spi);
		
		$packet = [
		$c->_getDeviceOpcode(0, PiFaceCommon::WRITE_CMD),
		PiFaceCommon::GPPUB,
		0xFF
		];
		
		$spi->expects($this->once())
		->method('transfer')
		->with($packet);
		
		$c->write(0xFF, PiFaceCommon::GPPUB, 0);
		
	}
	
	
	public function testRead () {
		$spi = $this->getMock('Pkj\Raspberry\PiFace\SpiManager\FileSpiManager', array('transfer'), array(0,0));
		
		$c = new PiFaceCommon($spi);
		
		$spi->expects($this->once())
		->method('transfer')
		->will($this->returnValue(array(null,null,0xFF)));
		
		$this->assertEquals(0XFF, $c->read(PiFaceCommon::GPPUB, 2));
		
	}
}