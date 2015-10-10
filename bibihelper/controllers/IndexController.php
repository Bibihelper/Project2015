<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use app\models\User;
use app\models\SpecialOffer;
use app\models\Category;
use app\models\Brand;
use app\models\Address;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\forms\RestorePswForm;
use app\components\Common;

class IndexController extends Controller
{
    private function index($message = '', $showCaptcha = false)
    {
        $user = User::findIdentity(Yii::$app->user->id);

        $regFrm = new RegisterForm();
        $rstFrm = new RestorePswForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        if ($showCaptcha) {
            $logFrm = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN_CAPTCHA]);
        } else {
            $logFrm = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN]);
        }

        $address = new Address();
        $distr   = $address->getDistrict();
        
        $category = Category::find()->all();
        $brand  = Brand::find()->all();
        
        return $this->render('index', [
            'user'   => $user,
            'spOffs' => $spOffs,
            'regFrm' => $regFrm,
            'logFrm' => $logFrm,
            'rstFrm' => $rstFrm,
            'responseMessage' => $message,
            'distr'    => $distr,
            'category' => $category,
            'brand'  => $brand,
        ]);
    }

    public function actionIndex()
    {
        return $this->index();
    }
    
    public function actionRegisterSuccess()
    {
        return $this->index(Common::M_EMAIL_SEND);
    }
    
    public function actionRestorepswConfirm()
    {
        return $this->index(Common::M_PSW_EMAIL_SEND);
    }
    
    public function actionRestorepswSuccess()
    {
        return $this->index(Common::M_PSW_RESTORE_SUCCESS);
    }
    
    public function actionLoginCaptcha()
    {
        return $this->index('', true);
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
    
    public function actionValidateRestorepswForm()
    {
        $rstFrm = new RestorePswForm();
        
        if (Yii::$app->request->isAjax && $rstFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($rstFrm);
        }
    }
}
