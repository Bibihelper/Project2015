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
}
