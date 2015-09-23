<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\SpecialOffer;
use app\models\User;

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

        $user = new User();
        
        if ($user) {
            $err = $user->createUser($data['email'], $data['password'], $data['passwordConfirm']);
        } else {
            $err = 4;
        }
        
        if ($err) {
            $status = "ERROR";
            
            switch ($err) {
                case 1: $error = "Неверный email"; break;
                case 2: $error = "Минимальная длина пароля - 6 символов"; break;
                case 3: $error = "Пароли не совпадают"; break;
                case 4: $error = "Unknown error"; break;
                case 5: $error = "Не удалось сохранить данные. Повторите попытку позже."; break;
            }
        }
        
        return '<?xml version="1.0" encoding="utf-8" ?><root>'
                . '<status>' . $status . '</status>'
                . '<code>' . $err . '</code>'
                . '<error>'  . $error  . '</error>'
            . '</root>';
    }
}
