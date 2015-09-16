<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $country
 * @property string $name
 */
class Brand extends ActiveRecord
{
    public static function tableName()
    {
        return 'brand';
    }

    public function rules()
    {
        return [
            [['country', 'name'], 'required'],
            [['country'], 'string', 'max' => 32],
            [['name'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'name' => 'Name',
        ];
    }
}
