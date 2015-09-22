<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "company_brands".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $brand_id
 */
class CompanyBrands extends ActiveRecord
{
    public static function tableName()
    {
        return 'company_brands';
    }

    public function rules()
    {
        return [
            [['company_id', 'brand_id'], 'required'],
            [['company_id', 'brand_id'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'brand_id' => 'Brand ID',
        ];
    }
    
    public function addCompanyBrand($cid, $bid)
    {
        $brandCount = $this->find()
            ->where(['company_id' => $cid, 'brand_id' => $bid])
            ->count();
        
        if ($brandCount > 0) {
            return true;
        } else {
            $this->company_id = $cid;
            $this->brand_id = $bid;
            return $this->save();
        }
    }
    
    public function removeCompanyBrand($cid, $bid)
    {
        $brand = $this->find()
            ->where(['company_id' => $cid, 'brand_id' => $bid]);
        
        $brandCount = $brand->count();

        if ($brandCount > 0) {
            $brandall = $brand->all();
            
            foreach ($brandall as $brnd) {
                $ok = $brnd->delete();
                if (!$ok) {
                    return false;
                }
            }
        }
        
        return true;
    }

    public function setCompanyBrand($cid, $bid, $state)
    {
        switch ($state) {
            case 0: return $this->removeCompanyBrand($cid, $bid);
            case 1: return $this->addCompanyBrand($cid, $bid);
        }
    }
}
