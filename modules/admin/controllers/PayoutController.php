<?php

namespace app\modules\admin\controllers;

use app\components\Email;
use app\models\Payout;
use app\models\Transaction;
use app\models\User;
use Yii;
use app\modules\admin\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class PayoutController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        \Yii::$app->params['activePage'] = 'partner';
        return array_merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ]);
    }

    /**
     * Lists all Payout models.
     * @return mixed
     */
    public function actionIndex()
    {

        $arGet = Yii::$app->request->get();

        $arUsers = User::find()->where(['role' => 'agent'])->all();
        $obQuery = Payout::find()->joinWith(['user'])->orderBy(['date' => SORT_DESC]);

        if (isset($arGet['status_id'])) {
            $obQuery = $obQuery->where(['status' => $arGet['status_id']]);
        }

        if (!empty($arGet['user_id'])) {
            $obQuery = $obQuery->where(['user_id' => $arGet['user_id']]);
        }

        if (!empty($arGet['date_from'])) {
            $obQuery = $obQuery->andWhere('date > :date_from',
                array(':date_from' => date('Y-m-d', strtotime($arGet['date_from']))));
        }

        if (!empty($arGet['date_to'])) {
            $obQuery = $obQuery->andWhere('date < :date_to',
                array(':date_to' => date('Y-m-d', strtotime($arGet['date_to']))));
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $obQuery,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'users' => $arUsers,
            'viewOnly' => !\Yii::$app->user->can('admin')
        ]);
    }

    /**
     * Displays a single Payout model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionUpdate($id)
    {
        $model = Payout::find()->where(['id' => $id])->one();

        if (Yii::$app->request->isPost) {

            $arPost = Yii::$app->request->post();

            //Списание
            if ($arPost['Payout']['status'] == 1) {

                $obTransaction = new Transaction();

                $arLog = [];

                $obTransaction->user_id = $arLog['user_id'] = $model->user_id;
                $obTransaction->direction = $arLog['direction'] = 2;
                $obTransaction->sum = $arLog['sum'] = $model->sum;
                $obTransaction->payout_id = $arLog['payout_id'] = $model->id;
                $obTransaction->comment = $arLog['comment'] = 'Выведено';
                $obTransaction->save();
                \Yii::info($arLog, 't');

                $obUser = User::find()->where(['id' => $model->user_id])->one();

                if (!empty($obUser)) {
                    $obUser->payout = $obUser->payout + $model->sum;
                    $obUser->save();
                }

                Email::notify('partner/transaction', ['model' => $obTransaction]);
            }

            $model->status = $arPost['Payout']['status'];
            Email::notify('partner/payout', ['model' => $model]);
            $model->save();
            return $this->redirect('/admin/payout');
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    protected function findModel($id)
    {
        if (($model = Payout::find()->joinWith(['user'])->where(['payout.id' => $id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
