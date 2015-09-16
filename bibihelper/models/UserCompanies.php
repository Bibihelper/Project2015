<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_companies".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $user_id
 */
class UserCompanies extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_companies';
    }

    public function rules()
    {
        return [
            [['company_id', 'user_id'], 'required'],
            [['company_id', 'user_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
        ];
    }
}
