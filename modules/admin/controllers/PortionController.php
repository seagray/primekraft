<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Portion;
use app\models\Product;
use app\models\Flavor;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * PortionController implements the CRUD actions for Portion model.
 */
class PortionController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        \Yii::$app->params['activePage'] = 'catalogue';
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
     * Lists all Portion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Portion::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Portion model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Portion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Portion();
        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');
        $flavors = ArrayHelper::map(Flavor::find()->all(), 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('create', [
                'model' => $model,
                'products' => $products,
                'flavors' => $flavors,
            ]);
        }
    }

    /**
     * Updates an existing Portion model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $products = ArrayHelper::map(Product::find()->all(), 'id', 'name');
        $flavors = ArrayHelper::map(Flavor::find()->all(), 'id', 'name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
                'products' => $products,
                'flavors' => $flavors,
            ]);
        }
    }

    /**
     * Deletes an existing Portion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Portion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Portion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Portion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
