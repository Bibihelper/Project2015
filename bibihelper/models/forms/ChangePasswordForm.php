<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\components\Common;

class ChangePasswordForm extends Model
{
    public $old_password;
    public $new_password;
    public $ok_password;

    public function rules()
    {
        return [
            [['old_password', 'new_password', 'ok_password'], 'required', 'message' => Common::M_FIELD_CANNOT_BE_BLANK],
            ['old_password', 'validateOldPassword'],
            ['new_password', 'string', 'length' => [6, 32], 'tooShort' => Common::M_MIN_PASSWORD_LENGTH, 'tooLong' => Common::M_MAX_PASSWORD_LENGTH],
            ['ok_password', 'compare', 'compareAttribute' => 'new_password', 'message' => Common::M_PASSWORDS_NOT_MATCH],
        ];
    }
    
    public function attributeLabels() {
        return [
            'old_password' => 'Старый пароль',
            'new_password' => 'Новый пароль',
            'ok_password' => 'Подтверждение',
        ];
    }
    
    public function validateOldPassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = User::findIdentity(Yii::$app->user->id);
            
            if ($user && !$user->validatePassword($this->old_password)) {
                $this->addError($attribute, Common::M_WRONG_PASSWORD);
            }
        }
    }
}
