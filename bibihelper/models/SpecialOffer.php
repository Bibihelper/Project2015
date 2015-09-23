<?php

namespace app\models;

use Yii;
use app\models\Files;

/**
 * This is the model class for table "special_offer".
 *
 * @property integer $id
 * @property string $comment
 * @property string $active_from
 * @property string $active_to
 * @property integer $file_id
 * @property integer $company_id
 */
class SpecialOffer extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'special_offer';
    }

    public function rules()
    {
        return [
            [['comment', 'active_from', 'active_to', 'file_id', 'company_id'], 'required'],
            [['comment'], 'string'],
            [['active_from', 'active_to'], 'safe'],
            [['file_id', 'company_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'comment' => 'Comment',
            'active_from' => 'Active From',
            'active_to' => 'Active To',
            'file_id' => 'File ID',
            'company_id' => 'Company ID',
        ];
    }
    
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['id' => 'file_id']);
    }
    
    public function getActiveFrom()
    {
        $activeFrom = $this->active_from;
        
        if ($activeFrom == null) {
            $activeFrom = date('Y-m-d H:i:s');
        }
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $activeFrom);
        return $date->getTimestamp() * 1000;
    }

    public function getActiveTo()
    {
        $activeTo = $this->active_to;
        
        if ($activeTo == null) {
            $activeTo = date('Y-m-d H:i:s', strtotime("now +10 days"));
        }
        
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $activeTo);
        return $date->getTimestamp() * 1000;
    }
}
