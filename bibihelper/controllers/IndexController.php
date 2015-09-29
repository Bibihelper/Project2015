<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\SpecialOffer;
use app\models\RegisterForm;
use app\models\LoginForm;

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
