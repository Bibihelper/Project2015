<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class PrivateRoomController extends Controller
{
    public function actionIndex()
    {
        return $this->render('/private-room/private-room');
    }
}
