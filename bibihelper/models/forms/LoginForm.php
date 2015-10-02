<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\components\Common;

class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberme = true;
    
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
            ['email', 'emailNotConfirmed'],
            ['password', 'string', 'length' => [6, 32], 'tooShort' => Common::M_MIN_PASSWORD_LENGTH, 'tooLong' => Common::M_MAX_PASSWORD_LENGTH],
            ['password', 'validatePassword'],
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

    public function emailNotConfirmed($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->getUser() && $this->getUser()->email_confirm == 0) {
                $this->addError($attribute, Common::M_EMAIL_NOT_CONFIRMED);
            }
        }
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $ok = $this->getUser()->validatePassword($this->password);
            if (!$ok) {
                $this->addError($attribute, Common::M_WRONG_PASSWORD);
            }
        }
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
