<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\UserCompanies;
use app\models\Company;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $email_confirm_token
 * @property integer $email_confirm
 * @property integer $role_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $last_auth_date
 * @property integer $active
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['name', 'password_hash', 'email'], 'required'],
            [['email_confirm', 'role_id', 'active'], 'integer'],
            [['created_at', 'updated_at', 'last_auth_date'], 'safe'],
            [['name', 'auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'email_confirm_token'], 'string', 'max' => 255]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'email_confirm_token' => 'Email Confirm Token',
            'email_confirm' => 'Email Confirm',
            'role_id' => 'Role ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'last_auth_date' => 'Last Auth Date',
            'active' => 'Active',
        ];
    }

    public function getUserCompanies()
    {
        return $this->hasMany(UserCompanies::className(), ['user_id' => 'id']);
    }
    
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id'])
            ->via('userCompanies');
    }    

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public static function findByEmail($email)
    {
        return self::find()->where(['email' => $email])->one();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function getPassword()
    {
        return $this->password_hash;
    }

    public function changePassword($data)
    {
        if (empty($data['pswOld']) != 0 || !$this->validatePassword($data['pswOld'])) {
            return 1;
        }
        
        if (strlen($data['pswNew']) < 6) {
            return 2;
        }
        
        if ($data['pswNew'] !== $data['pswCnf']) {
            return 3;
        }
        
        $this->password_hash = Yii::$app->security->generatePasswordHash($data["pswNew"]);
        $this->save();
            
        return 0;
    }
    
    public function changeEmail($data)
    {
        $regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
        
        $e = empty($data['email']);
        $r = preg_match($regex, $data['email']);
        
        if ($e != 0 || $r != 1) {
            return 1;
        }
        
        $this->email = $data['email'];
        $this->save();
        
        return 0;
    }
}
