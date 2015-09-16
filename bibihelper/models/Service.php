<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Category;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 */
class Service extends ActiveRecord
{
    public static function tableName()
    {
        return 'service';
    }

    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 50]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'category_id' => 'Category ID',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }    
}
