<?php
namespace Pkj\Raspberry\PiFace\Components;

class InputItem extends Item {

	public function getValue () {
		return 1 ^ $this->handler->readBit($this->pinNum, PiFaceDigital::INPUT_PORT, $this->boardNum);
	}
}