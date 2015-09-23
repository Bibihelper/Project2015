<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\models\Company;
use app\models\Shedule;
use app\models\User;
use app\models\Category;
use app\models\Country;
use app\models\Brand;
use app\models\CompanyServices;
use app\models\CompanyBrands;
use app\models\SpecialOffer;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class PrivateRoomController extends Controller
{
    public function actionIndex($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Url::home());
        }
        
        $k = $c[0]->brand;
        $n = Brand::find()->filterByCountry('Германия')->filterByBrand(2)->all();
        
        $company = Company::findOne($id);
        $shedule = Shedule::getSheduleString($company->id);
        $categories = Category::find()->all();
        $countries = Country::find()->all();
        
        return $this->render('/private-room/private-room', [
            'company' => $company, 
            'brands' => $brands,
            'shedule' => $shedule,
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }
    
    public function actionLogin() 
    {
        $post = Yii::$app->request->post();
        $email = $post['email'];
        $password = $post['psw'];
        $rmbrMe = $post['rmbr'] == 1 ? true : false;
        $auth = 0;
        $user = User::findByEmail($email);
        
        if (!$user) {
            $auth = 1;
        } else 
        
        if ($user->email_confirm == 0) {
            $auth = 2;
        } else 
        
        if (!$user->validatePassword($password)) {
            $auth = 3;
        } else {
            $auth = Yii::$app->user->login($user, $rmbrMe ? 3600 * 24 * 30 : 0) ? 0 : 4;
        }
        
        if ($auth == 0 && $rmbrMe) {
            Yii::$app->user->setReturnUrl('/private-room/?id=' . $user->company->id);
        }
        
        switch ($auth) {
            case 1: $error = "Учетная запись не существует"; break;
            case 2: $error = "Учетная запись не активированна"; break;
            case 3: $error = "Неверный пароль"; break;
            case 4: $error = "Unknown error"; break;
        }
        
        $status = ($auth === 0) ? 'OK' : 'ERROR';
        $responce = '<?xml version="1.0" encoding="utf-8" ?><root>'
                . '<status>' . $status . '</status>'
                . '<companyID>' . $user->company->id . '</companyID>'
                . '<code>' . $auth . '</code>'
                . '<error>' . $error . '</error>'
            . '</root>';
        
        return $responce;
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::home());
    }

    public function actionLoadImage($id)
    {
        foreach ($_FILES as $file) {
            $fileTmpName = $file['tmp_name'];
            $fileName    = $file['name'];
            $fileRPath   = '/data/' . $id . '/';
            $fileFPath   = Yii::$app->basePath . '/web' . $fileRPath;
        }
        
        if (!is_writable($fileFPath)) {
            
            chmod($fileFPath, 0777);
            
        }
        
        $mv = move_uploaded_file($fileTmpName, $fileFPath . $fileName);
        
        if ($mv) {
            $imagine = new Imagine();
            $image = $imagine->open($fileFPath . $fileName);
            $box = new Box(700, 420);
            $image->resize($box)->save();
        }

        $status = ($mv) ? 'OK' : 'ERROR';
        $responce = '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status><filename>' . $fileRPath . $fileName . '</filename></root>';
        
        return $responce;
    }
    
    public function actionSetCompanyService()
    {
        $status = 'OK';
        $data = Yii::$app->request->post();      
        
        $cmid  = $data['cmid'];
        $sbid  = $data['sbid'];
        $state = $data['state'];
        
        $cs = new CompanyServices();
        $err = $cs->setCompanyService($cmid, $sbid, $state);
        
        if (!$err) {
            $status = 'ERROR';
        }

        return '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status></root>';;
    }
    
    public function actionSetCompanyBrand()
    {
        $status = 'OK';
        $data = Yii::$app->request->post();      
        
        $cmid  = $data['cmid'];
        $sbid  = $data['sbid'];
        $state = $data['state'];
        
        $cb = new CompanyBrands();
        $ok = $cb->setCompanyBrand($cmid, $sbid, $state);
        
        if (!$ok) {
            $status = 'ERROR';
        }

        return '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status></root>';;
    }
    
    public function actionSetCompanyComment()
    {
        $status = "OK";
        $data = Yii::$app->request->post();
        
        $cid = $data["cid"];
        $txt = $data["txt"];
        
        $company = Company::findOne($cid);
        
        if ($company) {
            $ok = $company->setComment($txt);
        } else {
            $status = "ERROR";
        }

        if (!$ok) {
            $status = 'ERROR';
        }

        return '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status></root>';;
    }
    
    public function actionSetSpecialOffer()
    {
        $status = "OK";
        $data = Yii::$app->request->post();
        $sp = new SpecialOffer();
        $ok = $sp->setSpecialOffer($data);
        
        if (!$ok) {
            $status = "ERROR";
        }
        
        return '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status></root>';;
    }
    
    public function actionRemoveSpecialOffer()
    {
        $status = "OK";
        $data = Yii::$app->request->post();
        $sp = new SpecialOffer();
        $ok = $sp->removeSpecialOffer($data['cid']);
        
        if (!$ok) {
            $status = "ERROR";
        }
        
        return '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status></root>';;
    }
    
    public function actionChangePassword()
    {
        $status = "OK";
        $err = 0;
        $error = "";
        $company = $user = null;
        $data = Yii::$app->request->post();
        $company = Company::findOne($data['cid']);
        
        if ($company) {
            $user = $company->user;
        } else {
            $err = 4;
        }
        
        if ($user) {
            $err = $user->changePassword($data);
        } else {
            $err = 4;
        }
        
        if ($err) {
            $status = "ERROR";
            
            switch ($err) {
                case 1: $error = "Неверный старый пароль"; break;
                case 2: $error = "Минимальная длина пароля - 6 символов"; break;
                case 3: $error = "Пароли не совпадают"; break;
                case 4: $error = "Unknown error"; break;
            }
        }
        
        return '<?xml version="1.0" encoding="utf-8" ?><root>'
                . '<status>' . $status . '</status>'
                . '<code>' . $err . '</code>'
                . '<error>'  . $error  . '</error>'
            . '</root>';
    }
    
    public function actionChangeEmail()
    {
        $status = "OK";
        $err = 0;
        $error = "";
        $company = $user = null;
        $data = Yii::$app->request->post();
        $company = Company::findOne($data['cid']);
        
        if ($company) {
            $user = $company->user;
        } else {
            $err = 4;
        }
        
        if ($user) {
            $err = $user->changeEmail($data);
        } else {
            $err = 4;
        }
        
        if ($err) {
            $status = "ERROR";
            
            switch ($err) {
                case 1: $error = "Неверный email"; break;
                case 4: $error = "Unknown error"; break;
            }
        }
        
        return '<?xml version="1.0" encoding="utf-8" ?><root>'
                . '<status>' . $status . '</status>'
                . '<code>' . $err . '</code>'
                . '<error>'  . $error  . '</error>'
            . '</root>';
    }
}
