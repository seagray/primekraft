<?php

namespace app\controllers;

use app\components\BaseController;
use app\models\Order;

class OrderController extends BaseController
{
    public function actionIndex(){
        $this->enableCsrfValidation = false;
        $obOrder = new Order();

        return $this->render('index', [
            'arItems'=>$obOrder->getItems(),
            'nTotal' =>$obOrder->getTotal(),
            'arFields'=>$obOrder->getFields()
        ]);
    }

}