<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use app\models\Brand;

/**
 * This is the query class for table "brand".
 *
 * @property integer $id
 * @property string $country
 * @property string $name
 */
class CountryQuery extends ActiveQuery
{
    public function dst()
    {
        return $this->select('country')->distinct();
    }
}

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $country
 * @property string $name
 */
class Country extends ActiveRecord
{
    public static function tableName()
    {
        return 'brand';
    }

    public function rules()
    {
        return [
            [['country'], 'required'],
            [['country'], 'string', 'max' => 32]
        ];
    }

    public function attributeLabels()
    {
        return [
            'country' => 'Country',
        ];
    }
    
    public static function find()
    {
        $cq = new CountryQuery(get_called_class());
        
        return $cq->dst();
    }

    public function getBrand()
    {
        return $this->hasMany(Brand::className(), ['country' => 'country']);
    }
}
