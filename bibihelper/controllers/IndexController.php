<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use app\models\User;
use app\models\SpecialOffer;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\components\Common;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $user = User::findIdentity(Yii::$app->user->id);

        $regFrm = new RegisterForm();
        $logFrm = new LoginForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('index', [
            'user'   => $user,
            'spOffs' => $spOffs,
            'regFrm' => $regFrm,
            'logFrm' => $logFrm,
        ]);
    }
    
    public function actionValidateLoginForm()
    {
        $logFrm = new LoginForm();
        
        if (Yii::$app->request->isAjax && $logFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($logFrm);
        }
    }
    
    public function actionValidateRegisterForm()
    {
        $regFrm = new RegisterForm();
        
        if (Yii::$app->request->isAjax && $regFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($regFrm);
        }
    }
    
    public function actionRegisterSuccess()
    {
        $regFrm = new RegisterForm();
        $logFrm = new LoginForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('index', [
            'spOffs' => $spOffs,
            'regFrm' => $regFrm,
            'logFrm' => $logFrm,
            'responseMessage' => Common::M_EMAIL_SEND,
        ]);
    }
}
