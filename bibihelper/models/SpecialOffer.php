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
        $result = $this->hasOne(Files::className(), ['id' => 'file_id']);
        
        if ($result->count() == 0) {
            $result = new Files();
        }
        
        return $result;
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
    
    public function saveFile($data)
    {
        $file = new Files();
        $src  = $file->getSrc ($data['image']);
        $name = $file->getName($data['image']);
        $fid  = $file->saveFile($src, $name);
        return $fid;
    }

    public function addSpecialOffer($data, $fileID = null)
    {
        $dt1 = new \DateTime($data['activeFrom']);
        $dt2 = new \DateTime($data['activeTo']);

        $this->comment = $data['comment'];
        $this->active_from = $dt1->format("Y-m-d H:i:s");
        $this->active_to = $dt2->format("Y-m-d H:i:s");
        $this->file_id = $fileID;
        $this->company_id = $data['cid'];
        $this->save();
        return $this->id;
    }
    
    public function removeSpecialOffer($cid)
    {
        $sp = $this->find()
            ->where(["company_id" => $cid]);
        if ($sp->count()) {
            foreach ($sp->all() as $val) {
                $ok = $val->delete();
                if (!$ok) {
                    return false;
                }
            }
        }
        return true;
    }    
    
    public function setSpecialOffer($data)
    {
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
            
        $rem = $this->removeSpecialOffer($data['cid']);
        if (!$rem) {
            $transaction->rollBack();
            return false;
        }
        
        $fid = $this->saveFile($data);
        if (!$fid) {
            $transaction->rollBack();
            return false;
        }
        
        $sid = $this->addSpecialOffer($data, $fid);
        if (!$sid) {
            $transaction->rollBack();
            return false;
        }

        $transaction->commit();
        return true;
    }
}
