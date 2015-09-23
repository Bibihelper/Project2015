<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SpecialOffer;
use app\models\User;
use app\models\Address;
use app\models\Company;
use app\models\UserCompanies;

class IndexController extends Controller
{
    public function actionIndex()
    {
        $spOffs = new SpecialOffer();
        $spOffs = $spOffs->getAllSpecialOffers();
        
        return $this->render('index', [
            'spOffs' => $spOffs,
        ]);
    }
    
    public function actionRegister()
    {
        $status = "OK";
        $err = 0;
        $error = "";
        $data = Yii::$app->request->post();

        $err = $this->createService($data['email'], $data['password'], $data['passwordConfirm']);
        
        if ($err) {
            $status = "ERROR";
            
            switch ($err) {
                case 1: $error = "Неверный email"; break;
                case 2: $error = "Минимальная длина пароля - 6 символов"; break;
                case 3: $error = "Пароли не совпадают"; break;
                case 4: $error = "Unknown error"; break;
                case 5: $error = "Не удалось сохранить данные. Повторите попытку позже."; break;
                case 6: $error = "Пользователь с таким E-mail уже существует"; break;
            }
        }
        
        return '<?xml version="1.0" encoding="utf-8" ?><root>'
                . '<status>' . $status . '</status>'
                . '<code>' . $err . '</code>'
                . '<error>'  . $error  . '</error>'
            . '</root>';
    }
    
    public function createService($email, $password, $passwordConfirm)
    {
        $regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
        
        $e = empty($email);
        $r = preg_match($regex, $email);
        
        if ($e || $r != 1) {
            return 1;
        }
        
        if (strlen($password) < 6) {
            return 2;
        }
        
        if ($password !== $passwordConfirm) {
            return 3;
        }
        
        $val = User::findByEmail($email);
        if ($val) {
            return 6;
        }
        
        $db = Yii::$app->db;
        
        $transaction = $db->beginTransaction();
        
        try {
            
            $user = new User();
            $user->name = $email;
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->password_hash = Yii::$app->security->generatePasswordHash($password);
            $user->password_reset_token = "";
            $user->email = $email;
            $user->email_confirm_token = "";
            $user->email_confirm = 0;
            $user->role_id = 0;
            $user->created_at = date("Y-m-d H:i:s");
            $user->updated_at = date("Y-m-d H:i:s");
            $user->last_auth_date = 0;
            $user->active = 1;
            $user->save();
            
            $userID = $user->id;
            
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
            
            $addressID = $address->id;
            
            $company = new Company();
            $company->created_at = date("Y-m-d H:i:s");
            $company->name = $email;
            $company->comment = "";
            $company->phone = "";
            $company->twenty_four_hours = 0;
            $company->active = 1;
            $company->status_d = 0;
            $company->address_id = $addressID;
            $company->save();
            
            $companyID = $company->id;
            
            $uc = new UserCompanies();
            $uc->user_id = $userID;
            $uc->company_id = $companyID;
            $uc->save();
            
            $path = Yii::$app->basePath . '/web/data/' . $userID . '/';
            $ok = mkdir($path, 0777, true);
            
            if (!$ok) {
                $transaction->rollBack();
                return 5;
            }
            
            $transaction->commit();
            
        } catch (Exception $e) {
            
            $transaction->rollBack();
            return 5;
            
        }
        
        return 0;
    }
}
