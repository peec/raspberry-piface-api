<?php
namespace Pkj\Raspberry\PiFace\Components;


class SwitchItem extends InputItem {
	public function __construct(PiFaceCommon $handler, $switchNum, $boardNum = 0) {
		if ($switchNum < 0 || $switchNum > 3) {
			throw new RangeError(sprintf("Specified switch index (%d) out of range.", $switchNum));
		}
		parent::__construct($handler, $switchNum, $boardNum);
	}
}
