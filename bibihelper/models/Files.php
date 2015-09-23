<?php

namespace app\models;

/**
 * This is the model class for table "files".
 *
 * @property integer $id
 * @property string $src
 * @property string $name
 */
class Files extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'files';
    }

    public function rules()
    {
        return [
            [['src', 'name'], 'required'],
            [['src', 'name'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'src' => 'Src',
            'name' => 'Name',
        ];
    }
    
    public function getFileFullName($defName = "/images/s-img.png")
    {
        $value = $this->src . $this->name;
        
        if ($value == null) {
            $value = $defName;
        }
        
        return $value;
    }
    
    public function saveFile($src, $name)
    {
        $this->src  = $src;
        $this->name = $name;
        $this->save();
        return $this->id;
    }
    
    public function getSrc($path)
    {
        return pathinfo($path, PATHINFO_DIRNAME) . '/';
    }
    
    public function getName($path)
    {
        return pathinfo($path, PATHINFO_BASENAME);
    }
}
