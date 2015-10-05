<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Company;
use app\models\Address;
use app\models\Shedule;
use app\models\Category;
use app\models\SpecialOffer;
use app\models\Files;
use app\components\Common;
use app\models\forms\CompanyInfoForm;
use yii\helpers\ArrayHelper;

class CompanyController extends Controller
{
    public function actionGetCard($cid)
    {
        $company = Company::find()
            ->where(['id' => $cid])
            ->asArray()
            ->one();
        
        $address = Address::find()
            ->where(['id' => $company['address_id']])
            ->asArray()
            ->one();
        
        $shedule = Shedule::find()
            ->where(['company_id' => $cid])
            ->asArray()
            ->all();
        
        $brand = Company::find()
            ->where(['id' => $cid])
            ->one()
            ->brand;
        
        $service = Company::find()
            ->where(['id' => $cid])
            ->one()
            ->service;
        
        $srv = ArrayHelper::getColumn($service, 'category_id');
        
        $category = Category::find()
            ->where(['id' => $srv])
            ->asArray()
            ->indexBy('id')
            ->all();
        
        $srv = ArrayHelper::map($service, 'id', 'name', 'category_id');
        
        $spoffer = SpecialOffer::find()
            ->where(['company_id' => $cid])
            ->asArray()
            ->one();
        
        $file = Files::find()
            ->where(['id' => $spoffer['file_id']])
            ->asArray()
            ->one();
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        
        $response = [
            'company'  => $company,
            'address'  => $address,
            'shedule'  => $shedule,
            'brand'    => $brand,
            'category' => $category,
            'service'  => $srv,
            'spoffer'  => $spoffer,
            'file'     => $file
        ];
        
        return $response;
    }
    
    public function actionSaveInfo()
    {
        $status = 'OK';
        $message = '';
        $cInfFrm = new CompanyInfoForm();
        
        if ($cInfFrm->load(Yii::$app->request->post())) {
            if (!$cInfFrm->saveInfo()) {
                $status = 'ERROR';
                $message = Common::M_DATA_SAVE_FAILED;
            }
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = ['status' => $status, 'message' => $message];
        return $response;
    }
}
