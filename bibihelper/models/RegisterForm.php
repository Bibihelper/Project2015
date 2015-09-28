<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use app\models\User;
use app\models\Address;
use app\models\Company;
use app\models\UserCompanies;

class RegisterForm extends Model
{
    public $email;
    public $password;
    public $passwordok;
    public $rememberMe = true;

    public function rules()
    {
        return [
            [['email', 'password', 'passwordok'], 'required'],
            ['email', 'validateEmail'],
            ['password', 'validatePassword'],
            ['passwordok', 'validatePasswordOk'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'Адрес электронной почты:',
            'password' => 'Пароль:',
            'passwordok' => 'Подтвердите пароль:',
        ];
    }

    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $regexp = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';

            if (!preg_match($regexp, $this->email)) {
                $this->addError($attribute, 'Неверный email');
            }
        }
            
        if (!$this->hasErrors()) {
            $user = User::findByEmail($this->email);
            
            if ($user) {
                $this->addError($attribute, 'Пользователь с таким email уже существует');
            }
        }
    }

    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (strlen($this->password) < 6) {
                $this->addError($attribute, 'Минимальная длина пароля - 6 символов');
            }
        }
    }

    public function validatePasswordOk($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if ($this->password !== $this->passwordok) {
                $this->addError($attribute, 'Пароли не совпадают');
            }
        }
    }
    
    private function createUser()
    {
        $user = new User();
        $user->name = $this->email;
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->password_reset_token = "";
        $user->email = $this->email;
        $user->email_confirm_token = Yii::$app->security->generateRandomString();
        $user->email_confirm = 0;
        $user->role_id = 0;
        $user->created_at = date("Y-m-d H:i:s");
        $user->updated_at = date("Y-m-d H:i:s");
        $user->last_auth_date = 0;
        $user->active = 1;
        $user->save();
        return $user->id;
    }
    
    private function createAddress()
    {
        $address = new Address();
        $address->region = "";
        $address->city = "";
        $address->district = "";
        $address->street = "";
        $address->home = "";
        $address->housing = "";
        $address->building = "";
        $address->metro = "";
        $address->latitude = 0;
        $address->longitude = 0;
        $address->save();
        return $address->id;
    }
    
    private function createCompany($addressID)
    {
        $company = new Company();
        $company->created_at = date("Y-m-d H:i:s");
        $company->name = $this->email;
        $company->comment = "";
        $company->phone = "";
        $company->twenty_four_hours = 0;
        $company->active = 1;
        $company->status_d = 0;
        $company->address_id = $addressID;
        $company->save();
        return $company->id;
    }
    
    private function linkUserCompany($userID, $companyID)
    {
        $uc = new UserCompanies();
        $uc->user_id = $userID;
        $uc->company_id = $companyID;
        $uc->save();
        return $us->id;
    }
    
    private function createUserDir($userID)
    {
        $path = Yii::$app->basePath . '/web/data/' . $userID . '/';
        return mkdir($path, 0777, true);
    }

    private function registerUser()
    {
        $db = Yii::$app->db;
        
        $transaction = $db->beginTransaction();
        
        try {
            
            $userID    = $this->createUser();
            $addressID = $this->createAddress();
            $companyID = $this->createCompany($addressID);
            
            $this->linkUserCompany($userID, $companyID);
            
            if (!$this->createUserDir($userID)) {
                $transaction->rollBack();
                return false;
            }
            
            $transaction->commit();
            
        } catch (Exception $e) {
            
            $transaction->rollBack();
            return false;
            
        }
        
        return true;
    }
    
    private function sendEmail($email, $userID, $emailConfirmToken)
    {
        $href = Url::base(true) . '/user/confirm/?id=' . $userID . '&token=' . $emailConfirmToken;
        
        $text = '<h3>BiBiHelper</h3>'
            . '<p>Для подтверждения регистрации перейдите по ссылке:</p>' 
            . '<p><a href="' . $href . '" title="">' . $href . '</a></p>';
        
        Yii::$app->mailer->compose()
            ->setFrom('bibihelper.test1@yandex.ru')
            ->setTo($email)
            ->setSubject(Url::base(true) . ' - подтверждение регистрации')
            ->setHtmlBody($text)
            ->send();
    }
    
    public function register()
    {
        if ($this->registerUser()) {
            $user = User::findByEmail($this->email);
            if ($user) {
                $this->sendEmail($user->email, $user->id, $user->email_confirm_token);
                return true;
            }
        }
        return false;
    }
}
