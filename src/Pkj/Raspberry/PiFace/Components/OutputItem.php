<?php
namespace Pkj\Raspberry\PiFace\Components;


class OutputItem extends Item {

	public function getValue () {
		return $this->handler->readBit($this->pinNum, PiFaceDigital::OUTPUT_PORT, $this->boardNum);
	}

	public function setValue ($data) {
		return $this->handler->writeBit($data, $this->pinNum, PiFaceDigital::OUTPUT_PORT, $this->boardNum);
	}

	public function turnOn () {
		return $this->setValue(1);
	}

	public function turnOff () {
		return $this->setValue(0);
	}

	public function toggle () {
		$this->setValue(!$this->getValue());
	}

}
