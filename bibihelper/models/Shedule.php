<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the query class for table "shedule".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $day
 * @property string $begin
 * @property string $end
 */
class SheduleQuery extends ActiveQuery
{
    private $time = false;
    
    public function hasDay($day)
    {
        $count = $this->select(['*'])
            ->where(['day' => $day])
            ->count();
        
        return $count == 0 ? 0 : 1;
    }
    
    public function isEveryDay()
    {
        $count = $this->select(['*'])
            ->count();
        return $count == 7 ? 1 : 0;
    }
    
    public function getTime()
    {
        if (!$this->time) {
            $this->time = $this->select(['*'])
                ->one();
            if ($this->time == null) {
                $this->time['begin'] = "09:00";
                $this->time['end'] = '17:00';
            }
        }
        return $this->time;
    }
    
    public function getHour($bound = 'begin')
    {
        $time = $this->getTime();
        $dt = new \DateTime($time[$bound]);
        return $dt->format('H');
    }

    public function getMinute($bound = 'begin')
    {
        $time = $this->getTime();
        $dt = new \DateTime($time[$bound]);
        return $dt->format('i');
    }
}

/**
 * This is the model class for table "shedule".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $day
 * @property string $begin
 * @property string $end
 */
class Shedule extends ActiveRecord
{
    private static $DayOfWeek = [1 => 'пн', 'вт', 'ср', 'чт', 'пт', 'сб', 'вс'];
    
    public static function tableName()
    {
        return 'shedule';
    }

    public function rules()
    {
        return [
            [['company_id', 'begin', 'end'], 'required'],
            [['company_id', 'day'], 'integer'],
            [['begin', 'end'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'day' => 'Day',
            'begin' => 'Begin',
            'end' => 'End',
        ];
    }
    
    public static function find()
    {
        return new SheduleQuery(get_called_class());
    }

    public static function getSheduleTable($companyID)
    {
        $st = self::find(['company_id' => $companyID])
            ->orderBy('day')
            ->all();
        
        $shedule = array();
        
        foreach ($st as $t) {
            $shedule[$t->begin . ' - ' . $t->end][] = Shedule::$DayOfWeek[$t->day];
        }
        
        return $shedule;
    }
    
    public static function getSheduleString($companyID)
    {
        $st = self::getSheduleTable($companyID);
        $ss = '&nbsp;&nbsp;';
        
        foreach ($st as $tm => $ds) {
            $b = $ds[0];
            $e = $ds[count($ds) - 1];
            $ss = $ss . $b . ' - ' . $e . ': ' . $tm . '&nbsp;&nbsp;&nbsp;&nbsp;';
        }
        
        return $ss;
    }
}
