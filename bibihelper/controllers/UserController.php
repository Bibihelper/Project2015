<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\User;
use app\models\forms\RegisterForm;
use app\models\forms\LoginForm;
use app\models\forms\ChangePasswordForm;
use app\models\forms\ChangeEmailForm;
use app\components\Common;
use yii\helpers\Url;

class UserController extends Controller
{
    public function actionRegister()
    {
        $regFrm = new RegisterForm();
        
        if ($regFrm->load(Yii::$app->request->post()) && $regFrm->validate()) {
            $ok = $regFrm->register();
            if ($ok) {
                return $this->redirect(Url::to('/index/register-success/?message=' . Common::M_EMAIL_SEND));
            }
        }
        
        return $this->goHome();
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
        $logFrm = new LoginForm();
        
        if ($logFrm->load(Yii::$app->request->post()) && $logFrm->validate()) {
            $companyID = $logFrm->login();
            if ($companyID) {
                return $this->redirect(Url::to('/private-room/?id=' . $companyID));
            }
        }
        
        return $this->goHome();
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(Url::home());
    }
    
    public function actionChangePassword()
    {
        $cPasFrm = new ChangePasswordForm();
        $status = 'ERROR';
        $message = Common::M_CHANGE_PASSWORD_FAILED;
        
        if ($cPasFrm->load(Yii::$app->request->post()) && $cPasFrm->validate()) {
            $user = User::findIdentity(Yii::$app->user->id);
            if ($user) {
                $user->setPassword($cPasFrm->new_password);
                $status = 'OK';
                $message = Common::M_PASSWORD_CHANGED;
            }
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $responce = ['status' => $status, 'message' => $message];
        return $responce;
    }
    
    public function actionChangeEmail()
    {
        $cEmailFrm = new ChangeEmailForm();
        $status = 'ERROR';
        $message = Common::M_CHANGE_EMAIL_FAILED;
        
        if ($cEmailFrm->load(Yii::$app->request->post()) && $cEmailFrm->validate()) {
            $user = User::findIdentity(Yii::$app->user->id);
            if ($user) {
                $user->setEmail($cEmailFrm->email);
                $status = 'OK';
                $message = Common::M_EMAIL_CHANGED;
            }
        }
        
        Yii::$app->response->format = Response::FORMAT_JSON;
        $responce = ['status' => $status, 'message' => $message];
        return $responce;
    }
}
