<?php

namespace app\modules\admin\controllers;

use app\models\Transaction;
use app\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\BaseController;

class TransactionController extends BaseController
{
    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {

        $arGet = \Yii::$app->request->get();

        $arUsers = User::find()->where(['role' => 'agent'])->all();
        $obQuery = Transaction::find()->joinWith(['user'])->orderBy(['date' => SORT_DESC]);

        $userId = isset($arGet['user_id']) ? $arGet['user_id'] : null;
        if (!empty($userId)) {
            $obQuery = $obQuery->where(['user_id' => $userId]);
        }

        $dateFrom = isset($arGet['date_from']) ? $arGet['date_from'] : null;
        $dateTo = isset($arGet['date_to']) ? $arGet['date_to'] : null;

        if (!empty($dateFrom)) {
            $obQuery = $obQuery->andWhere('date >= :date_from',
                array(':date_from' => date('Y-m-d 00:00:00', strtotime($dateFrom))));
        }

        if (!empty($dateTo)) {
            $obQuery = $obQuery->andWhere('date <= :date_to',
                array(':date_to' => date('Y-m-d 23:59:59', strtotime($dateTo))));
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $obQuery,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'userId' => $userId,
            'users' => $arUsers,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Transaction::find()->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
