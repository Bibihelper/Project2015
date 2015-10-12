<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\components\Common;

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
        $addr = [];
        
        if ( $this->city     ) { $addr[] = Common::fmtCity     ( $this->city     ); }
        if ( $this->street   ) { $addr[] = Common::fmtStreet   ( $this->street   ); }
        if ( $this->home     ) { $addr[] = Common::fmtHome     ( $this->home     ); }
        if ( $this->housing  ) { $addr[] = Common::fmtHousing  ( $this->housing  ); }
        if ( $this->building ) { $addr[] = Common::fmtBuilding ( $this->building ); }
        
        return implode(', ', $addr);
    }
    
    public function getDistrict($city = '')
    {
        return $this->find()
            ->select(['district'])
            ->andWhere(['!=', 'district', ''])
            ->andFilterWhere(['city' => $city])
            ->distinct()
            ->orderBy('district')
            ->all();
    }
}
