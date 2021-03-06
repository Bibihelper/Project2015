<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\Company;
use app\models\Shedule;
use app\components\Common;

class OptionsForm extends Model
{
    public $id;
    public $company_name;
    public $address_region;
    public $address_city;
    public $address_district;
    public $address_street;
    public $address_home;
    public $address_housing;
    public $address_building;
    public $address_metro;
    public $shedule_twfhr;
    public $shedule_every_day;
    public $shedule_mon;
    public $shedule_tue;
    public $shedule_wed;
    public $shedule_thu;
    public $shedule_fri;
    public $shedule_sat;
    public $shedule_sun;
    public $b_hour;
    public $b_minute;
    public $e_hour;
    public $e_minute;
    public $company_phone;

    public function rules()
    {
        return [
            [['id', 'company_name'], 'required', 'message' => Common::M_FIELD_CANNOT_BE_BLANK],
            [['address_region', 'address_city', 'address_district'], 'string', 'max' => 32, 'message' => Common::M_FIELD_MAX_LENGTH_32],
            ['address_street', 'string', 'max' => 255, 'message' => Common::M_FIELD_MAX_LENGTH_255],
            [['address_home', 'address_housing', 'address_building'], 'string', 'max' => 10, 'message' => Common::M_FIELD_MAX_LENGTH_10],
            ['address_metro', 'string', 'max' => 50, 'message' => Common::M_FIELD_MAX_LENGTH_50],
            [['company_name'], 'match', 'pattern' => '/^[а-яА-ЯёЁa-zA-Z0-9-_\s\."@]*$/u', 'message' => Common::M_COMPANY_NAME],
            [['address_region', 'address_city', 'address_district', 'address_street', 'address_home', 'address_housing',
                'address_building', 'address_metro'], 'match', 'pattern' => '/^[а-яА-ЯёЁ0-9-\s]*$/u', 'message' => Common::M_ADDRESS],
            ['company_phone', 'match', 'pattern' => '/^(\+7) \(?\d{3}\) (\d{3})\-(\d{2})\-(\d{2})$/', 'message' => Common::M_PHONE],
            [['shedule_twfhr', 'shedule_every_day', 'shedule_mon', 'shedule_tue', 'shedule_wed', 'shedule_thu', 'shedule_fri', 'shedule_sat', 'shedule_sun'], 'boolean'],
            [['b_hour', 'b_minute', 'e_hour', 'e_minute'], 'integer'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'id' => '',
            'company_name' => 'Название автосервиса:',
            'address_region' => 'Регион:',
            'address_city' => 'Город:',
            'address_district' => 'Район:',
            'address_street' => 'Улица:',
            'address_home' => 'Дом:',
            'address_housing' => 'Корпус:',
            'address_building' => 'Строение:',
            'address_metro' => 'Станция метро:',
            'shedule_twfhr' => 'круглосуточно',
            'shedule_every_day' => 'ежедневно',
            'shedule_mon' => 'понедельник',
            'shedule_tue' => 'вторник',
            'shedule_wed' => 'среда',
            'shedule_thu' => 'четверг',
            'shedule_fri' => 'пятница',
            'shedule_sat' => 'суббота',
            'shedule_sun' => 'воскресенье',
            'b_hour' => '',
            'b_minute' => '',
            'e_hour' => '',
            'e_minute' => '',
            'company_phone' => 'Телефон:',
        ];
    }
    
    public function loadData($id)
    {
        $company = Company::findOne($id);
        $address = $company->address;
        $shedule = $company->getShedule();
        $this->id = $id;
        $this->company_name = $company->name;
        $this->address_region = $address->region;
        $this->address_city = $address->city;
        $this->address_district = $address->district;
        $this->address_street = $address->street;
        $this->address_home = $address->home;
        $this->address_housing = $address->housing;
        $this->address_building = $address->building;
        $this->address_metro = $address->metro;
        $this->shedule_twfhr = $company->twenty_four_hours;
        $this->shedule_every_day = $shedule->isEveryDay();
        $this->shedule_mon = $shedule->hasDay(1);
        $this->shedule_tue = $shedule->hasDay(2);
        $this->shedule_wed = $shedule->hasDay(3);
        $this->shedule_thu = $shedule->hasDay(4);
        $this->shedule_fri = $shedule->hasDay(5);
        $this->shedule_sat = $shedule->hasDay(6);
        $this->shedule_sun = $shedule->hasDay(7);
        $this->b_hour = $shedule->getHour();
        $this->b_minute = $shedule->getMinute();
        $this->e_hour = $shedule->getHour('end');
        $this->e_minute = $shedule->getMinute('end');
        $this->company_phone = $company->phone;
    }
    
    public function saveOptions()
    {
        $db = Yii::$app->db;
        
        $transaction = $db->beginTransaction();
        
        try {
            
            $company = Company::findOne($this->id);
            $company->name  = $this->company_name;
            $company->phone = $this->company_phone;
            $company->twenty_four_hours = $this->shedule_twfhr;
            $company->save();
            
            $address = $company->address;
            $address->region   = $this->address_region;
            $address->city     = $this->address_city;
            $address->district = $this->address_district;
            $address->street   = $this->address_street;
            $address->home     = $this->address_home;
            $address->housing  = $this->address_housing;
            $address->building = $this->address_building;
            $address->metro    = $this->address_metro;
            $address->save();
            
            Shedule::deleteAll(['company_id' => $company->id]);
            
            $days = array(1 => 'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun');
            
            for ($i = 1; $i <= 7; $i++) {
                $day = 'shedule_' . $days[$i];
            
                if ($this[$day] == 1) {
                    $shedule = new Shedule();
                    $shedule->company_id = $company->id;
                    $shedule->day        = $i;
                    $shedule->begin      = $this->b_hour . ':' . $this->b_minute . ':00';
                    $shedule->end        = $this->e_hour . ':' . $this->e_minute . ':00';
                    $shedule->save();
                }
            }
            
            $transaction->commit();
            
        } catch (Exception $e) {
        
            $transaction->rollBack();
            return false;
            
        }
        
        return true;
    }
}
