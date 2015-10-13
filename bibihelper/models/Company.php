<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\CompanyBrands;
use app\models\Brand;
use app\models\Address;
use app\models\CompanyServices;
use app\models\Service;
use app\models\User;
use app\models\SpecialOffer;
use app\models\Shedule;
use app\models\City;
use yii\helpers\ArrayHelper;

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
class Company extends ActiveRecord
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
    
    public function getShedule()
    {
        return $this->hasMany(Shedule::className(), ['company_id' => 'id']);
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
    
    public function getSpecialOffer()
    {
        $result = $this->hasOne(SpecialOffer::className(), ['company_id' => 'id']);
        
        if ($result->count() == 0) {
            $result = new SpecialOffer();
        }
        
        return $result;
    }
    
    public function hasOffer()
    {
        $result = $this->hasOne(SpecialOffer::className(), ['company_id' => 'id']);

        return $result->count() > 0;
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
    
    public function getSrchRes($city = null, $brand = null, $service = null, $district = null, $name = null, $address = null, $twfhr = null)
    {
        $cityObj = City::findOne($city);
        
        if ($address) {
            $a1 = str_replace(' ', ',', trim($address));
            $a2 = explode(',', $a1);
            if ($a2) {
                $a4 = [];
                foreach ($a2 as $a3) {
                    if (mb_strlen($a3, 'UTF-8') > 4)
                        $a4[] = $a3;
                }
                if (count($a4) > 0) {
                    $a5 = implode('%', $a4);
                    $address = $a5;
                }
            }
        }
        
        $srchres = $this->find()
            ->select([
                    'company.id', 'company.name', 'company.phone', 'company.twenty_four_hours',
                    'address.city', 'address.district', 'address.street',
                        'address.home', 'address.housing', 'address.building', 'address.latitude', 'address.longitude',
                    'special_offer.id AS special_offer_id',
                    'company_brands.id AS company_brands_id',
                    'company_services.id AS company_services_id'
                ])
            ->leftJoin('address', '`address`.`id` = `company`.`address_id`')
            ->leftJoin('special_offer', '`special_offer`.`company_id` = `company`.`id`')
            ->leftJoin('company_brands', '`company_brands`.`company_id` = `company`.`id`')
            ->leftJoin('company_services', '`company_services`.`company_id` = `company`.`id`')
            ->filterWhere([
                    'company_brands.brand_id' => $brand,
                    'company_services.service_id' => $service,
                    'address.city' => $cityObj['name'],
                    'address.district' => $district,
                    'company.name' => $name,
                    'company.twenty_four_hours' => $twfhr,
                ])
            ->andFilterWhere(['like', 'address.street', $address])
            ->asArray()
            ->all();
        
        $id = ArrayHelper::getColumn($srchres, 'id');
        
        $shedule = Shedule::find()
            ->where(['company_id' => $id])
            ->asArray()
            ->all();
        
        $shedule2 = [];
        
        foreach ($shedule as $sh) {
            $companyID = $sh['company_id'];
            $shedule2[$companyID][] = $sh;
        }
        
        for ($i = 0; $i < count($srchres); $i++) {
            $companyID = $srchres[$i]['id'];
            $srchres[$i]['shedule'] = $shedule2[$companyID];
        }
        
        return $srchres;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this->save();
    }
}





