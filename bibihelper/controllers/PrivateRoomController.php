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

class PrivateRoomController extends Controller
{
    public $companyID = 0;
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user = false;
    
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
        
        $this->email        = $post['email'];
        $this->password     = $post['psw'];
        $this->rememberMe   = $post['rmbr'] == 1 ? true : false;
        
        if ($this->validatePassword()) {
            $auth = Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
            $this->companyID = $this->_user->company->id;
            
            if ($this->rememberMe) {
                Yii::$app->user->setReturnUrl('/private-room/?id=' . $this->companyID);
            }
        }
        
        $status = ($auth) ? 'OK' : 'ERROR';
        $responce = '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status><companyID>' . $this->companyID . '</companyID></root>';
        
        return $responce;
    }
    
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(Url::home());
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
    
    public function validatePassword()
    {
        $user = $this->getUser();

        if (!$user || !$user->validatePassword($this->password)) {
            return false;
        }
        
        return true;
    }
    
    public function actionLoadImageTmp($id)
    {
        foreach ($_FILES as $file) {
            $fileTmpName = $file['tmp_name'];
            $fileName    = $file['name'];
            $fileRPath   = '/web/data/' . $id . '/';
            $fileFPath   = Yii::$app->basePath . $fileRPath;
        }
        
        if (!is_writable($fileFPath)) {
            
            chmod($fileFPath, 0777);
            
        }
        
        $mv = move_uploaded_file($fileTmpName, $fileFPath . $fileName);

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
        $err = $cb->setCompanyBrand($cmid, $sbid, $state);
        
        if (!$err) {
            $status = 'ERROR';
        }

        return '<?xml version="1.0" encoding="utf-8" ?><root><status>' . $status . '</status></root>';;
    }
}
