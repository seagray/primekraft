<?php

namespace app\modules\admin\controllers;

use app\models\Discount;
use app\models\DiscountValue;
use app\models\User;
use Yii;
use yii\base\ErrorException;
use app\modules\admin\components\BaseController;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class DiscountController extends BaseController
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
     * Список
     * @return string
     */
    public function actionIndex()
    {

        $arGet = Yii::$app->request->get();

        $arUsers = User::find()->where(['role' => 'agent'])->all();
        $obQuery = Discount::find()->orderBy(['date' => SORT_DESC]);

        if (!empty($arGet['user_id'])) {
            $obQuery = $obQuery->where(['user_id' => $arGet['user_id']]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $obQuery,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'arUsers' => $arUsers,
            'viewOnly' => !\Yii::$app->user->can('admin')
        ]);
    }

    /**
     * Просмотр
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Создание промо-кода
     * @return string|\yii\web\Response
     * @throws \yii\base\ErrorException
     */
    public function actionCreate()
    {
        $arUsers = [
            0 => 'Нет партнера'
        ];
        $model = new Discount();

        $users = User::find()->where(['is_code' => 0])->all();

        foreach ($users as $obUser) {
            $arUsers[$obUser->id] = $obUser->username;
        }

        if (Yii::$app->request->isPost) {

            $arPost = Yii::$app->request->post('Discount');

            if (!empty($arPost['code'])) {
                $model->code = $arPost['code'];
            }

            if (!empty($arPost['lifetime'])) {
                $model->lifetime = date('Y-m-d H:i:s', strtotime($arPost['lifetime']));
            }

            if (!empty($arPost['user_id'])) {
                $model->user_id = $arPost['user_id'];
            }

            if ($obUser = User::find()->where(['id' => $arPost['user_id']])->one()) {
                if ($obUser->is_code == 1) {
                    throw new ErrorException('У пользователя уже есть код');
                }

                $obUser = User::find()->where(['id' => $arPost['user_id']])->one();
                $obUser->is_code = 1;
                $obUser->save();
            }
            $bSave = $model->save();

            $arDiscounts = Yii::$app->params['discounts'];

            foreach ($arDiscounts as $nProductId => $nDiscount) {
                $obValue = new DiscountValue();

                $obValue->discount_id = $model->id;
                $obValue->product_id = $nProductId;
                $obValue->percent = $nDiscount;
                $obValue->save();
            }

            if ($bSave) {
                return $this->redirectAfterSave($model->id);
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'users' => $arUsers
            ]);
        }
    }

    /**
     * Редактирование
     * @param $id
     * @return string|\yii\web\Response
     * @throws \yii\base\NotSupportedException
     */
    public function actionUpdate($id)
    {
        $arUsers = [];
        $model = Discount::find()->where(['discount.id' => $id])->joinWith(['values.product'])->one();

        $users = User::find()->where(['is_code' => 0]);

        if (!empty($model->user_id)) {
            $users = $users->where(['id' => $model->user_id]);
        } else {
            $arUsers[0] = 'Нет партнера';
        }

        $users = $users->all();

        foreach ($users as $obUser) {
            $arUsers[$obUser->id] = $obUser->username;
        }

        $arValues = [];

        if (isset($model->values) && !empty($model->values)) {
            $arValues = $model->values;
        }

        if (Yii::$app->request->isPost) {

            $arPost = Yii::$app->request->post();

            $model->code = $arPost['Discount']['code'];
            $model->lifetime = !empty($arPost['Discount']['lifetime']) ? date('Y-m-d H:i:s', strtotime($arPost['Discount']['lifetime'])) : null;


            if (empty($model->user_id)) {
                $model->user_id = $arPost['Discount']['user_id'];
            }

            $obUser = User::find()->where(['id' => $arPost['Discount']['user_id']])->one();

            if ($obUser->is_code == 1) {
                //throw new NotSupportedException('У пользователя уже есть код');
            }

            $model->save();

            if (!empty($arPost['discounts'])) {
                $arValues = DiscountValue::find()->where(['discount_id' => $model->id])->all();
                foreach ($arValues as $obValue) {
                    $obValue->delete();
                }

                foreach ($arPost['discounts'] as $nProductId => $nDiscount) {
                    $obValue = new DiscountValue();

                    $obValue->discount_id = $model->id;
                    $obValue->product_id = $nProductId;
                    $obValue->percent = $nDiscount;
                    $obValue->save();
                }
            }

            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
                'users' => $arUsers,
                'values' => $arValues
            ]);
        }
    }

    /**
     * Удаление
     * @param $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $obModel = $this->findModel($id);
        $nUserId = $obModel->user_id;
        $obModel->delete();

        $arValues = DiscountValue::find()->where(['discount_id' => $id])->all();

        foreach ($arValues as $obValue) {
            $obValue->delete();
        }

        if ($obUser = User::find()->where(['id' => $nUserId])->one()) {
            $obUser->is_code = 0;
            $obUser->save();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Discount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
