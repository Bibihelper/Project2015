<?php

namespace app\components;

use yii\captcha\CaptchaAction;

class MyCaptchaAction extends CaptchaAction
{
    public $foreColor = 0x38b2ce;
    
    public function validate($input, $caseSensitive)
    {
        return $input === $this->verifyCode;
    }
}
