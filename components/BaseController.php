<?php

namespace app\components;

use app\models\Discount;

class BaseController extends SeoIgniteController
{
    private function getPromo()
    {
        $promo = \Yii::$app->request->get('promo');
        if (!empty($promo)) {
            Discount::setPromo($promo);
        }
    }

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $this->getPromo();
            return true;
        }
        return false;
    }
}