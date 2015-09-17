<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $region
 * @property string $city
 * @property string $district
 * @property string $street
 * @property string $home
 * @property string $housing
 * @property string $building
 * @property string $metro
 * @property double $latitude
 * @property double $longitude
 */
class Address extends ActiveRecord
{
    public static function tableName()
    {
        return 'address';
    }

    public function rules()
    {
        return [
            [['latitude', 'longitude'], 'number'],
            [['region', 'city', 'district', 'home', 'housing', 'building'], 'string', 'max' => 32],
            [['street'], 'string', 'max' => 255],
            [['metro'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'region' => 'Region',
            'city' => 'City',
            'district' => 'District',
            'street' => 'Street',
            'home' => 'Home',
            'housing' => 'Housing',
            'building' => 'Building',
            'metro' => 'Metro',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
        ];
    }
    
    public function getAddressStr()
    {
        $city     = ($this->city     == null) ? '' : 'г. ' . $this->city;
        $street   = ($this->street   == null) ? '' : ', ул. ' . $this->street;
        $home     = ($this->home     == null) ? '' : ', д. ' . $this->home;
        $housing  = ($this->housing  == null) ? '' : ', к. ' . $this->housing;
        $building = ($this->building == null) ? '' : ', стр. ' . $this->building;
        
        return $city . $street . $home . $housing . $building;
    }
}
