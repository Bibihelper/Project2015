<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\SpecialOffer;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\forms\RestorePswForm;

class SpecialOffersController extends Controller
{
    public function actionIndex()
    {
        $user = User::findIdentity(Yii::$app->user->id);

        $regFrm = new RegisterForm();
        $logFrm = new LoginForm();
        $rstFrm = new RestorePswForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('specialoffers', [
            'user'   => $user,
            'spOffs' => $spOffs,
            'regFrm' => $regFrm,
            'logFrm' => $logFrm,
            'rstFrm' => $rstFrm,
        ]);
    }
}
