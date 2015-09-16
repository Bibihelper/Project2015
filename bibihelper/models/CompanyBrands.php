<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "company_brands".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $brand_id
 */
class CompanyBrands extends ActiveRecord
{
    public static function tableName()
    {
        return 'company_brands';
    }

    public function rules()
    {
        return [
            [['company_id', 'brand_id'], 'required'],
            [['company_id', 'brand_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'brand_id' => 'Brand ID',
        ];
    }
}
