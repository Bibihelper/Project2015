<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\SpecialOffer;
use app\models\RegisterForm;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $regFrm = new RegisterForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('index', [
            'spOffs' => $spOffs,
            'regFrm' => $regFrm,
        ]);
    }
}
