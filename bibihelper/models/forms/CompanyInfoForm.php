<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\Company;

class CompanyInfoForm extends Model
{
    public $id;
    public $info;

    public function rules()
    {
        return [
            ['id', 'required'],
            ['info', 'string'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'id' => '',
            'info' => '',
        ];
    }

    public function loadInfo($id)
    {
        $company = Company::findOne($id);
        $this->id = $id;
        $this->info = $company->comment;
    }

    public function saveInfo()
    {
        $company = Company::findOne($this->id);
        if ($company) {
            $company->setComment($this->info);
            return true;
        }
        return false;
    }
}
