<?php

namespace app\models;

use yii\db\ActiveRecord;

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
class User extends ActiveRecord
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
}
