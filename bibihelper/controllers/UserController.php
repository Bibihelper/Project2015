<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\components\Common;
use yii\helpers\Url;

class UserController extends Controller
{
    public function actionRegister()
    {
        $status = 'OK';
        $message = Common::M_EMAIL_SEND;

        $regFrm = new RegisterForm();
        
        if ($regFrm->load(Yii::$app->request->post()) && $regFrm->validate()) {
            if (!$regFrm->register()) {
                $status = 'ERROR';
                $message = Common::M_FAILED_SAVE_DATA;
            }
        } else {
            $status = 'ERROR';
            $message = implode(' ', $regFrm->getFirstErrors());
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = ['status' => $status, 'message' => $message];
        return $response;
    }
    
    public function actionConfirm($id, $token)
    {
        $user = User::findOne($id);
        
        if ($user && $user->email_confirm_token == $token) {
            $user->email_confirm = 1;
            $user->save();
            Yii::$app->user->login($user, 0);
            Yii::$app->user->setReturnUrl('/private-room/?id=' . $user->company->id);
            return $this->redirect('/private-room/?id=' . $user->company->id);
        }
    }
    
    public function actionLogin()
    {
        $status = 'OK';
        $message = '';
        $companyid = 0;
        
        $logFrm = new LoginForm();
        
        if ($logFrm->load(Yii::$app->request->post()) && $logFrm->validate()) {
            if ($logFrm->validatePassword()) {
                if (!($companyid = $logFrm->login())) {
                    $status = 'ERROR';
                    $message = Common::M_LOGIN_FAILED;
                }
            } else {
                $status = 'ERROR';
                $message = Common::M_WRONG_PASSWORD;
            }
        } else {
            $status = 'ERROR';
            $message = implode(' ', $logFrm->getFirstErrors());
        }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = ['status' => $status, 'message' => $message, 'companyid' => $companyid];
        return $response;
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Url::home());
    }
}
