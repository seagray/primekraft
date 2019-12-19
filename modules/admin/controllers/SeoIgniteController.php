<?php

namespace app\modules\admin\controllers;

use app\models\SeoIgniteImage;
use app\models\SeoIgniteStorage;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use app\modules\admin\components\BaseController;

class SeoIgniteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        \Yii::$app->params['activePage'] = 'seo-ignite';
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
     * Lists all
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SeoIgniteStorage::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SeoIgniteStorage
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeoIgniteStorage();

      //  $model->og_image_file = UploadedFile::getInstance($model, 'og_image_file');

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing
     * @param integer $id
     * @throws \yii\base\ErrorException
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = SeoIgniteStorage::findOne($id);

       // $model->og_image_file = $_POST['Bill']["physical_number"];
       // $model->og_image_file = UploadedFile::getInstance($model, 'og_image_file');

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the model
     * @param integer $id
     * @return SeoIgniteStorage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeoIgniteStorage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImages()
    {
        $query = SeoIgniteImage::find();

        $src = \Yii::$app->request->get('src');
        if (!empty($src)) {
            $query->where(['like', 'src', $src]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        return $this->render('images', [
            'dataProvider' => $dataProvider,
            'src' => $src
        ]);
    }

    public function actionImageCreate()
    {
        $model = new SeoIgniteImage();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['images']);
        } else {
            return $this->render('image_create', [
                'model' => $model,
            ]);
        }
    }

    public function actionImageUpdate($id)
    {
        if (($model = SeoIgniteImage::findOne($id)) !== null) {
            if ($model->load(\Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['images']);
            } else {
                return $this->render('image_update', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new NotFoundHttpException('Запись не найдена.');
        }
    }

    public function actionImageDelete($id)
    {
        if (($model = SeoIgniteImage::findOne($id)) !== null) {
            $model->delete();
            return $this->redirect(['images']);
        } else {
            throw new NotFoundHttpException('Запись не найдена.');
        }
    }
}
