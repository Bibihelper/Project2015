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
use app\models\Company;
use app\models\City;
use app\models\Address;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\forms\RestorePswForm;
use app\components\Common;

class IndexController extends Controller
{
    public function actionIndex($mid = '', $f = 0)
    {
        $user = User::findIdentity(Yii::$app->user->id);

        $regFrm = new RegisterForm();
        $rstFrm = new RestorePswForm();
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        if ($f) {
            $logFrm = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN_CAPTCHA]);
        } else {
            $logFrm = new LoginForm(['scenario' => LoginForm::SCENARIO_LOGIN]);
        }
        
        $city = City::find()->all();

        $address = new Address();
        $distr   = $address->getDistrict();
        
        $category = Category::find()->all();
        $brand  = Brand::find()->all();
        
        $msg = '';
        
        switch ($mid) {
            case 1: $msg = Common::M_EMAIL_SEND;          break;
            case 2: $msg = Common::M_PSW_EMAIL_SEND;      break;
            case 3: $msg = Common::M_PSW_RESTORE_SUCCESS; break;
        }
        
        return $this->render('index', [
            'msg'      => $msg,
            'user'     => $user,
            'spOffs'   => $spOffs,
            'regFrm'   => $regFrm,
            'logFrm'   => $logFrm,
            'rstFrm'   => $rstFrm,
            'city'     => $city,
            'distr'    => $distr,
            'category' => $category,
            'brand'    => $brand,
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
    
    public function actionValidateRestorepswForm()
    {
        $rstFrm = new RestorePswForm();
        
        if (Yii::$app->request->isAjax && $rstFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($rstFrm);
        }
    }
    
    public function actionSrchRes()
    {
        $data = Yii::$app->request->post();
        
        $city     = $this->pval($data['city']); 
        $brand    = $this->pval($data['brand']); 
        $service  = $this->pval($data['service']); 
        $district = $this->pval($data['district']); 
        $name     = $this->pval($data['name']); 
        $address  = $this->pval($data['address']); 
        $twfhr    = $this->pval($data['twfhr']);
        
        $company = new Company();
        $srchres = $company->getSrchRes($city, $brand, $service, $district, $name, $address, $twfhr);
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['srchres' => $srchres];
        return $responce;
    }
    
    private function pval($value)
    {
        if ($value === '' || $value === '0' || $value === 'undefined' || $value === 0) {
            return null;
        }
        return $value;
    }
    
    public function actionGetCoords()
    {
        $data = Yii::$app->request->post();
        $cityID = $data['city'];
        
        $city = City::findOne($cityID);
        $cityName = null;
        if ($city) {
            $cityName = $city->name;
        }
        
        $address = Address::find()
            ->andFilterWhere(['city' => $cityName])
            ->asArray()
            ->all();
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['coords' => $address];
        return $responce;
    }
}
