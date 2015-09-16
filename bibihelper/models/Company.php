<?php

namespace app\models;

use app\models\CompanyBrands;
use app\models\Brand;
use app\models\Address;
use app\models\CompanyServices;
use app\models\Service;
use app\models\User;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $created_at
 * @property string $name
 * @property string $comment
 * @property string $phone
 * @property integer $twenty_four_hours
 * @property integer $active
 * @property integer $status_d
 * @property integer $address_id
 */
class Company extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'company';
    }

    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['name'], 'required'],
            [['comment'], 'string'],
            [['twenty_four_hours', 'active', 'status_d', 'address_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 20]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'name' => 'Name',
            'comment' => 'Comment',
            'phone' => 'Phone',
            'twenty_four_hours' => 'Twenty Four Hours',
            'active' => 'Active',
            'status_d' => 'Status D',
            'address_id' => 'Address ID',
        ];
    }
    
    public function getCompanyBrands()
    {
        return $this->hasMany(CompanyBrands::className(), ['company_id' => 'id']);
    }
    
    public function getBrand()
    {
        return $this->hasMany(Brand::className(), ['id' => 'brand_id'])
            ->via('companyBrands');
    }
    
    public function getAddress()
    {
        return $this->hasOne(Address::className(), ['id' => 'address_id']);
    }
    
    public function getCompanyServices()
    {
        return $this->hasMany(CompanyServices::className(), ['company_id' => 'id']);
    }
    
    public function getService()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])
            ->via('companyServices');
    }
    
    public function getUserCompanies()
    {
        return $this->hasMany(UserCompanies::className(), ['company_id' => 'id']);
    }
    
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id'])
            ->via('userCompanies');
    }    
}





