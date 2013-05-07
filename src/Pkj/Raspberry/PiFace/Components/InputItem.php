<?php
namespace Pkj\Raspberry\PiFace\Components;

use Pkj\Raspberry\PiFace\PiFaceCommon;
use Pkj\Raspberry\PiFace\PiFaceDigital;
use Pkj\Raspberry\PiFace\RangeError;

class InputItem extends Item {

	public function getValue () {
		return 1 ^ $this->handler->readBit($this->pinNum, PiFaceDigital::INPUT_PORT, $this->boardNum);
	}
}