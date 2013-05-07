<?php
namespace Pkj\Raspberry\PiFace\Components;


class LED extends OutputItem{

	public function __construct(PiFaceCommon $handler, $ledNum, $boardNum = 0) {
		if ($ledNum < 0 || $ledNum > 7) {
			throw new RangeError(sprintf("Specified LED index (%d) out of range.", $ledNum));
		}
		parent::__construct($handler, $ledNum, $boardNum);
	}
}
