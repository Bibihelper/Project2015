<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\ActiveQuery;
use app\models\Category;

/**
 * This is the query class for table "service".
 *
 * @property integer $id
 * @property string $name
 * @property integer $category_id
 */
class ServiceQuery extends ActiveQuery
{
    public function filterByCategory($categoryID = 0)
    {
        return $this->andWhere(['category_id' => $categoryID]);
    }

    public function filterByService($serviceID = 0)
    {
        return $this->andWhere(['id' => $serviceID]);
    }
    
    public function getServiceArrayID($categoryID = 0)
    {
        return $this->andWhere(['category_id' => $categoryID])
            ->column();
    }
}

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
    
    public static function find()
    {
        $sq = new ServiceQuery(get_called_class());
        $sq->orderBy('name');
        return $sq;
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }    
}
