<?php
namespace Pkj\Raspberry\PiFace;

class PiFaceDigitalTest extends \PHPUnit_Framework_TestCase {
	
	private function getInstance () {
		$spi = $this->getMock('Pkj\Raspberry\PiFace\SpiManager\SpiInterface');
		$common = new PiFaceCommon($spi);
		return new PiFaceDigital($common);
	}
	
	public function testBoardHasExactMatchOfComponents () {
		$p = $this->getInstance();
		
		$this->assertCount(8, $p->getInputPins(), "It is 8 input pins");
		$this->assertCount(8, $p->getOutputPins(), "It is 8 output pins");
		$this->assertCount(8, $p->getLeds(), "It is 8 leds");
		$this->assertCount(2, $p->getRelays(), "It is 2 relays");
		$this->assertCount(4, $p->getSwitches(), "It is 3 switches");
		
	}
	
	public function testCommonIsSet () {
		$p = $this->getInstance();
		
		$this->assertInstanceOf('Pkj\Raspberry\PiFace\PiFaceCommon', $p->getHandler());
	}
	

}