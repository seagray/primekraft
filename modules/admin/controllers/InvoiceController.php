<?php

namespace app\modules\admin\controllers;

use app\models\Order;
use Yii;
use app\models\Invoice;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoiceController implements the CRUD actions for Invoice model.
 */
class InvoiceController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
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
     * Lists all Invoice models.
     * @return mixed
     */
    public function actionIndex()
    {
        $get = Yii::$app->request->get();

        $query = Invoice::find();
        if (!empty($get['status'])) {
            $query->where(['status' => $get['status']]);
        }
        if (!empty($get['created'])) {
            $query->andWhere('created LIKE :created', [
                ':created' => date('Y-m-d', strtotime($get['created'])) . '%'
            ]);
        }
        if (!empty($get['closed'])) {
            $query->andWhere('closed LIKE :closed', [
                ':closed' => date('Y-m-d', strtotime($get['closed'])) . '%'
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoice model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'order' => Order::findOne(['invoice_id' => $id])
        ]);
    }

    /**
     * @param integer $id
     * @return mixed
     */
    public function actionPay($id)
    {
        $model = $this->findModel($id);
        $model->status = Invoice::STATUS_PAID;
        $model->save();

        return $this->redirectAfterSave($model->id);
    }


    /**
     * Deletes an existing Invoice model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionClose($id)
    {
        $model = $this->findModel($id);
        $model->status = Invoice::STATUS_FAILED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invoice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Invoice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoice::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
