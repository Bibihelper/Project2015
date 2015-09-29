<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use app\models\User;
use app\models\Address;
use app\models\Company;
use app\models\UserCompanies;

class LoginForm extends Model
{
    const M_WRONG_EMAIL = 'Неверный email';
    const M_EMAIL_NOT_EXISTS = 'Пользователя с таким E-mail не существует';
    const M_WRONG_PASSWORD = 'Неверный пароль';
    const M_MIN_PASSWORD_LENGTH = 'Минимальная длина пароля - 6 символов';
    
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
            ['email', 'validateEmail'],
            ['password', 'validatePasswordLength'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'Адрес электронной почты:',
            'password' => 'Пароль:',
            'rememberme' => 'Запомнить',
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $regexp = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';

            if (!preg_match($regexp, $this->email)) {
                $this->addError($attribute, self::M_WRONG_EMAIL);
            }
        }
            
        if (!$this->hasErrors()) {
            if (!$this->getUser()) {
                $this->addError($attribute, self::M_EMAIL_NOT_EXISTS);
            }
        }
    }

    public function validatePasswordLength($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (strlen($this->password) < 6) {
                $this->addError($attribute, self::M_MIN_PASSWORD_LENGTH);
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
