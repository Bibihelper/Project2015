<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use app\models\User;
use app\components\Common;

class RestorePswForm extends Model
{
    public $email;
    
    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email', 'message' => Common::M_WRONG_EMAIL],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'Адрес электронной почты:',
        ];
    }
    
    private function sendEmail($email, $userID, $passwordResetToken)
    {
        $href = Url::base(true) . '/user/restorepsw-confirm/?id=' . $userID . '&token=' . $passwordResetToken;
        
        $text = '<h3>BiBiHelper</h3>'
            . '<p>Для восстановления пароля перейдите по ссылке:</p>' 
            . '<p><a href="' . $href . '" title="">' . $href . '</a></p>'
            . '<p>Вам будет выслано на данный E-mail письмо с новым паролем.</p>';
        
        Yii::$app->mailer->compose()
            ->setFrom('bibihelper.test1@yandex.ru')
            ->setTo($email)
            ->setSubject(Url::base(true) . ' - восстановление пароля')
            ->setHtmlBody($text)
            ->send();
    }
    
    public function restorePsw()
    {
        $user = User::findByEmail($this->email);
        if ($user) {
            if ($user->password_reset_token === '') {
                $user->password_reset_token = Yii::$app->security->generateRandomString();
                $user->save();
            }
            $this->sendEmail($this->email, $user->id, $user->password_reset_token);
            return true;
        }
        return false;
    }
}
