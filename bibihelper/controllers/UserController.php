<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\RegisterForm;
use yii\helpers\Url;

class UserController extends Controller
{
    public function actionRegister()
    {
        $status = "OK";
        $code = 0;
        $message = "Вам на почту высланно письмо для подтверждения регистрации.";

        $regFrm = new RegisterForm();
        
        if ($regFrm->load(Yii::$app->request->post()) && $regFrm->validate()) {
            if (!$regFrm->register()) {
                $status = "ERROR";
                $code = 1;
                $message = "Не удалось сохранить данные. Повторите попытку позже.";
            }
        } else {
            $status = "ERROR";
            $code = 2;
            $message = "Не удалось поддтверидть правильность данных";
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = ['status' => $status, 'code' => $code, 'message' => $message];
        return $response;
    }
    
    public function actionConfirm($id, $token)
    {
        $user = User::findOne($id);
        
        if ($user && $user->email_confirm_token == $token) {
            $user->email_confirm = 1;
            $user->save();
            $this->redirect(Url::home());
            Yii::$app->user->login($user, 0);
            Yii::$app->user->setReturnUrl('/private-room/?id=' . $user->company->id);
            $this->redirect('/private-room/?id=' . $user->company->id);
        }
    }
}
