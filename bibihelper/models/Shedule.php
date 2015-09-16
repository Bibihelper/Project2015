<?php

namespace app\models;

use yii\db\ActiveRecord;



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
    
    public static function getSheduleTable($companyID)
    {
        $st = Shedule::find(['company_id' => $companyID])
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
        $st = Shedule::getSheduleTable($companyID);
        $ss = '';
        
        foreach ($st as $tm => $ds) {
            $b = $ds[0];
            $e = $ds[count($ds) - 1];
            $ss = $ss . $b . ' - ' . $e . ': ' . $tm . '; ';
        }
        
        return $ss;
    }
}
