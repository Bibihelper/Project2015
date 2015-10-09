<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\forms\RestorePswForm;

class AboutController extends Controller
{
    public function actionIndex()
    {
        $user = User::findIdentity(Yii::$app->user->id);

        $regFrm = new RegisterForm();
        $logFrm = new LoginForm();
        $rstFrm = new RestorePswForm();
        
        return $this->render('about', [
            'user'   => $user,
            'regFrm' => $regFrm,
            'logFrm' => $logFrm,
            'rstFrm' => $rstFrm,
        ]);
    }
}
