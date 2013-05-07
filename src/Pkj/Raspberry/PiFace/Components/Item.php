<?php
namespace Pkj\Raspberry\PiFace\Components;


abstract class Item {
	protected $handler;
	protected $pinNum;
	protected $boardNum;

	public function __construct(PiFaceCommon $handler, $pinNum, $boardNum = 0) {
		$this->handler = $handler;

		if ($boardNum < 0 || $boardNum > PiFaceDigital::MAX_BOARDS) {
			throw new RangeError(sprintf("Specified board index (%d) out of range.", $boardNum));
		}

		$this->boardNum = $boardNum;
		$this->pinNum = $pinNum;

	}
}
