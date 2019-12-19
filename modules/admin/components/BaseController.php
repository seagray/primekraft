<?php

namespace app\modules\admin\components;

use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

abstract class BaseController extends Controller
{
//    public function beforeAction(){
//
//        if (!\Yii::$app->user->can('view_admin')) {
//            throw new ForbiddenHttpException('Access denied');
//        }
//
//        return true;
//    }
//
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin']
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'index', 'view'
                        ],
                        'controllers' => [
                            'admin/transaction',
                            'admin/order',
                            'admin/payout',
                            'admin/vacancy',
                            'admin/default',
                            'admin/discount'
                        ],
                        'roles' => ['partner_manager']
                    ]
                ],
            ]
        ];
    }

    public function redirectAfterSave($id)
    {
        $to = \Yii::$app->request->post('__redirect_to', 'list');

        switch ($to) {
            case 'list':
                return $this->redirect(['index']);
            case 'view':
                return $this->redirect(['view', 'id' => $id]);
            case 'self':
                return $this->refresh();
        }

        throw new NotFoundHttpException();
    }
}