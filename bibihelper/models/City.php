<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 */
class CityQuery extends ActiveQuery
{

}

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 */
class City extends ActiveRecord
{
    public static function tableName()
    {
        return 'city';
    }

    public function rules()
    {
        return [
            [['name', 'latitude', 'longitude'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
    
    public static function find()
    {
        $cq = new CityQuery(get_called_class());
        $cq->orderBy('name');
        return $cq;
    }
}
