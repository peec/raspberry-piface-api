<?php
namespace Pkj\Raspberry\PiFace\Components;

use Pkj\Raspberry\PiFace\PiFaceCommon;
use Pkj\Raspberry\PiFace\PiFaceDigital;
use Pkj\Raspberry\PiFace\RangeError;

class SwitchItem extends InputItem {
	public function __construct(PiFaceCommon $handler, $switchNum, $boardNum = 0) {
		if ($switchNum < 0 || $switchNum > 3) {
			throw new RangeError(sprintf("Specified switch index (%d) out of range.", $switchNum));
		}
		parent::__construct($handler, $switchNum, $boardNum);
	}
}
