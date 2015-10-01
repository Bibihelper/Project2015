<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\SpecialOffer;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $regFrm = new RegisterForm();
        $logFrm = new LoginForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('index', [
            'spOffs' => $spOffs,
            'regFrm' => $regFrm,
            'logFrm' => $logFrm,
        ]);
    }
}
