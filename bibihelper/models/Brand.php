<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use app\models\Country;

/**
 * This is the model class for table "brand".
 *
 * @property integer $id
 * @property string $country
 * @property string $name
 */
class BrandQuery extends ActiveQuery
{
    public function filterByCountry($country = '')
    {
        return $this->andWhere(['country' => $country]);
    }

    public function filterByBrand($brandID = 0)
    {
        return $this->andWhere(['id' => $brandID]);
    }    
}

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
    
    public static function find()
    {
        $bq = new BrandQuery(get_called_class());
        $bq->orderBy('name');
        return $bq;
    }
    
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['country' => 'country']);
    }
}
