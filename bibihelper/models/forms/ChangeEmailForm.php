<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;
use app\components\Common;

class ChangeEmailForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'required', 'message' => Common::M_FIELD_CANNOT_BE_BLANK],
            ['email', 'email'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'E-mail',
        ];
    }
    
    public function loadEmail()
    {
        $user = User::findIdentity(Yii::$app->user->id);
        if ($user) {
            $this->email = $user->email;
        }
    }
}
