<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\SpecialOffer;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('index', [
            'spOffs' => $spOffs,
        ]);
    }
}
