<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\components\Common;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberme;
    
    private $_user = false;
    
    public function getUser()
    {
        if (!$this->_user) {
            $this->_user = User::findByEmail($this->email);
        }
        return $this->_user;
    }

    public function rules()
    {
        return [
            [['email', 'password'], 'required'],
            ['email', 'email', 'message' => Common::M_WRONG_EMAIL],
            ['email', 'emailNotExists'],
            ['password', 'string', 'length' => [6, 32], 'tooShort' => Common::M_MIN_PASSWORD_LENGTH, 'tooLong' => Common::M_MAX_PASSWORD_LENGTH],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'Адрес электронной почты:',
            'password' => 'Пароль:',
            'rememberme' => 'Запомнить',
        ];
    }

    public function emailNotExists($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (!$this->getUser()) {
                $this->addError($attribute, Common::M_EMAIL_NOT_EXISTS);
            }
        }
    }

    public function validatePassword()
    {
        return $this->getUser()->validatePassword($this->password);
    }

    public function login()
    {
        if ($this->getUser()) {
            $ok = Yii::$app->user->login($this->getUser(), $this->rememberme ? 3600 * 24 * 30 : 0);
            if ($ok) {
                Yii::$app->user->setReturnUrl('/private-room/?id=' . $this->getUser()->company->id);
                return $this->getUser()->company->id;
            }
        }
        return false;
    }
}
