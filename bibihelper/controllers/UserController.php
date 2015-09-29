<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\RegisterForm;
use app\models\LoginForm;
use yii\helpers\Url;

class UserController extends Controller
{
    const M_EMAIL_SEND = 'Вам на почту высланно письмо для подтверждения регистрации.';
    const M_FAILED_SAVE_DATA = 'Не удалось сохранить данные. Повторите попытку позже.';
    const M_LOGIN_FAILED = 'Не удалось произвести вход в систему. Повторите попытку позже.';
    
    public function actionRegister()
    {
        $status = 'OK';
        $code = 0;
        $message = self::M_EMAIL_SEND;

        $regFrm = new RegisterForm();
        
        if ($regFrm->load(Yii::$app->request->post()) && $regFrm->validate()) {
            if (!$regFrm->register()) {
                $status = 'ERROR';
                $code = 1;
                $message = self::M_FAILED_SAVE_DATA;
            }
        } else {
            $status = 'ERROR';
            $code = 2;
            $message = implode('<br>', $regFrm->getFirstErrors());
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
    
    public function actionLogin()
    {
        $status = 'OK';
        $code = 0;
        $message = '';
        $companyid = 0;
        
        $data = Yii::$app->request->post();

        $logFrm = new LoginForm();
        
        if ($logFrm->load(Yii::$app->request->post()) && $logFrm->validate()) {
            if (!($companyid = $logFrm->login())) {
                $status = 'ERROR';
                $code = 3;
                $message = self::M_LOGIN_FAILED;
            }
        } else {
            $status = 'ERROR';
            $code = 4;
            $message = implode('<br>', $logFrm->getFirstErrors());
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = ['status' => $status, 'code' => $code, 'message' => $message, 'companyid' => $companyid];
        return $response;
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Url::home());
    }
}
