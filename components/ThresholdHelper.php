<?php

namespace app\components;
use Yii;

require_once __DIR__ . "/../_api/service/ThresholdEngine.php";

class ThresholdHelper
{

    private $thold_type;

	public function __construct($type, $additional=[])
	{
        if (!empty($type)) {
            $this->thold_type = $type;
        }
	}

    // public function 
}