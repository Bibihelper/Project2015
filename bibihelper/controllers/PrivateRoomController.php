<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\models\Company;
use app\models\Shedule;
use app\models\User;
use app\models\Category;
use app\models\Country;
use app\models\CompanyServices;
use app\models\CompanyBrands;
use app\models\SpecialOffer;
use app\models\forms\CompanyInfoForm;
use app\models\forms\ChangePasswordForm;
use app\models\forms\ChangeEmailForm;
use app\models\forms\OptionsForm;
use app\components\Common;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class PrivateRoomController extends Controller
{
    public $enableCsrfValidation = false;
    
    public function actionIndex($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Url::home());
        }
        
        $user = User::findOne(Yii::$app->user->id);

        if ($user->company->id != $id) {
            return $this->redirect(Url::home());
        }
        
        $company = Company::findOne($id);
        $shedule = Shedule::getSheduleString($company->id);
        $categories = Category::find()->all();
        $countries = Country::find()->all();
        
        $cInfFrm = new CompanyInfoForm();
        $cInfFrm->loadInfo($id);
        
        $cPasFrm = new ChangePasswordForm();
        
        $cEmailFrm = new ChangeEmailForm();
        $cEmailFrm->loadEmail();
        
        $cOptFrm = new OptionsForm();
        $cOptFrm->loadData($id);
        
        return $this->render('/private-room/private-room', [
            'company' => $company, 
            'shedule' => $shedule,
            'categories' => $categories,
            'countries' => $countries,
            'cInfFrm' => $cInfFrm,
            'cPasFrm' => $cPasFrm,
            'cEmailFrm' => $cEmailFrm,
            'cOptFrm' => $cOptFrm,
        ]);
    }
    
    public function actionValidateChangePasswordForm()
    {
        $cPasFrm = new ChangePasswordForm();
        
        if (Yii::$app->request->isAjax && $cPasFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($cPasFrm);
        }
    }
    
    public function actionValidateChangeEmailForm()
    {
        $cEmailFrm = new ChangeEmailForm();
        
        if (Yii::$app->request->isAjax && $cEmailFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($cEmailFrm);
        }
    }
    
    public function actionValidateOptionsForm()
    {
        $cOptFrm = new OptionsForm();
        
        if (Yii::$app->request->isAjax && $cOptFrm->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($cOptFrm);
        }
    }
    
    public function actionLoadImage($id)
    {
        foreach ($_FILES as $file) {
            $fileTmpName = $file['tmp_name'];
            $fileName    = Common::transl($file['name']);
            $fileRPath   = '/data/' . $id . '/';
            $fileFPath   = Yii::$app->basePath . '/web' . $fileRPath;
        }
        
        if (!is_writable($fileFPath)) {
            
            chmod($fileFPath, 0777);
            
        }
        
        $mv = move_uploaded_file($fileTmpName, $fileFPath . $fileName);
        
        if ($mv) {
            $imagine = new Imagine();
            $image = $imagine->open($fileFPath . $fileName);
            $box = new Box(700, 420);
            $image->resize($box)->save();
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $status = ($mv) ? 'OK' : 'ERROR';
        $responce = ['status' => $status, 'filename' => $fileRPath . $fileName];
        return $responce;
    }
    
    public function actionSetCompanyService()
    {
        $status = 'OK';
        $data = Yii::$app->request->post();      
        
        $cmid  = $data['cmid'];
        $sbid  = $data['sbid'];
        $state = $data['state'];
        
        $cs = new CompanyServices();
        $err = $cs->setCompanyService($cmid, $sbid, $state);
        
        if (!$err) {
            $status = 'ERROR';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['status' => $status];
        return $responce;
    }
    
    public function actionSetCompanyBrand()
    {
        $status = 'OK';
        $data = Yii::$app->request->post();      
        
        $cmid  = $data['cmid'];
        $sbid  = $data['sbid'];
        $state = $data['state'];
        
        $cb = new CompanyBrands();
        $ok = $cb->setCompanyBrand($cmid, $sbid, $state);
        
        if (!$ok) {
            $status = 'ERROR';
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['status' => $status];
        return $responce;
    }
    
    public function actionSetSpecialOffer()
    {
        $status = "OK";
        $data = Yii::$app->request->post();
        $sp = new SpecialOffer();
        $ok = $sp->setSpecialOffer($data);
        
        if (!$ok) {
            $status = "ERROR";
        }
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['status' => $status];
        return $responce;
    }
    
    public function actionRemoveSpecialOffer()
    {
        $status = "OK";
        $data = Yii::$app->request->post();
        $sp = new SpecialOffer();
        $ok = $sp->removeSpecialOffer($data['cid']);
        
        if (!$ok) {
            $status = "ERROR";
        }
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['status' => $status];
        return $responce;
    }
    
    public function actionSaveOptions()
    {
        $status = 'OK';
        $message = '';
        $cOptFrm = new OptionsForm();
        
        if ($cOptFrm->load(Yii::$app->request->post())) {
            if (!$cOptFrm->saveOptions()) {
                $status = 'ERROR';
                $message = Common::M_DATA_SAVE_FAILED;
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = ['status' => $status, 'message' => $message];
        return $response;
    }
    
    public function actionSaveCoords()
    {
        $user = User::findOne(Yii::$app->user->id);
        if ($user) {
            $data = Yii::$app->request->post();
            $user->company->address->latitude  = $data['latitude'];
            $user->company->address->longitude = $data['longitude'];
            $user->company->address->save();
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['status' => 'OK'];
        return $responce;
    }
    
    public function actionGetCoords()
    {
        $user = User::findOne(Yii::$app->user->id);
        if ($user) {
            $lat = $user->company->address->latitude;
            $lng = $user->company->address->longitude;
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $responce = ['latitude' => $lat, 'longitude' => $lng];
        return $responce;
    }
}
