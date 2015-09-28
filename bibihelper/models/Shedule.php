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
                $this->time['begin'] = '09:00';
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
    
    public static function getSheduleString($companyID)
    {
        $shedule = self::find()
            ->where(['company_id' => $companyID])
            ->orderBy('day')
            ->all();
        
        $sheduleStr = '';
        
        foreach ($shedule as $day) {
            $dayNumber = $day->day;
            $dayName = self::$DayOfWeek[$dayNumber];
            $beginTime = \DateTime::createFromFormat('H:i:s', $day->begin);
            $endTime = \DateTime::createFromFormat('H:i:s', $day->end);
            $workTime = $beginTime->format('H:i') . '-' . $endTime->format('H:i');
            $sheduleStr .= $dayName . ': ' . $workTime . '<br>';
        }
        
        return $sheduleStr;
    }
}
