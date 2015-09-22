<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "company_services".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $service_id
 */
class CompanyServices extends ActiveRecord
{
    public static function tableName()
    {
        return 'company_services';
    }

    public function rules()
    {
        return [
            [['company_id', 'service_id'], 'required'],
            [['company_id', 'service_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'service_id' => 'Service ID',
        ];
    }
    
    public function addCompanyService($cid, $sid)
    {
        $serviceCount = $this->find()
            ->where(['company_id' => $cid, 'service_id' => $sid])
            ->count();
        
        if ($serviceCount > 0) {
            return true;
        } else {
            $this->company_id = $cid;
            $this->service_id = $sid;
            return $this->save();
        }
    }
    
    public function removeCompanyService($cid, $sid)
    {
        $service = $this->find()
            ->where(['company_id' => $cid, 'service_id' => $sid]);
        
        $serviceCount = $service->count();

        if ($serviceCount > 0) {
            $srvall = $service->all();
            
            foreach ($srvall as $srv) {
                $ok = $srv->delete();
                if (!$ok) {
                    return false;
                }
            }
        }
        
        return true;
    }

    public function setCompanyService($cid, $sid, $state)
    {
        switch ($state) {
            case 0: return $this->removeCompanyService($cid, $sid);
            case 1: return $this->addCompanyService($cid, $sid);
        }
    }
}
