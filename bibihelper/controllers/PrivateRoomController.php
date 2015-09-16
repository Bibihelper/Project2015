<?php

namespace app\controllers;

use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\Company;
use app\models\Shedule;

class PrivateRoomController extends Controller
{
    public function getCompanyId()
    {
        return 2;
    }

    public function actionIndex()
    {
        $company = Company::findOne($this->getCompanyId());
        $brands = array();
        
        foreach ($company->brand as $brand) {
            $brands[$company->id][$brand->country][] = $brand->name;
        }

        $srvs = array();
        
        foreach ($company->service as $srv) {
            $srvs[$company->id][$srv->category->name][] = $srv->name;
        }
        
        $shedule = Shedule::getSheduleString($company->id);
        
        return $this->render('/private-room/private-room', [
            'company' => $company, 
            'brands' => $brands,
            'shedule' => $shedule,
            'srvs' => $srvs,
        ]);
    }
}
