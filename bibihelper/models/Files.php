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
}
