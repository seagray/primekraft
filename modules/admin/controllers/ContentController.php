<?php

namespace app\modules\admin\controllers;

use yii;
use app\models\Content;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContentController implements the CRUD actions for Content model.
 */
class ContentController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        \Yii::$app->params['activePage'] = 'content';
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
     * Lists all Content models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Content::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Content model.
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
     * Creates a new Content model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Content();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Content model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
                'live_edit' => false
            ]);
        }
    }

    public function actionLiveedit($name)
    {
        if (($model = Content::findOne(['name' => urldecode($name)])) !== null) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()){
                    return json_encode(['success' => true]);
                } else {
                    return json_encode(['success' => false, 'errors' => $model->errors]);
                }

            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                    'live_edit' => true
                ]);
            }
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }

    /**
     * Deletes an existing Content model.
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
     * Finds the Content model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Content the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Content::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
