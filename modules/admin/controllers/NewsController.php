<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\News;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\helpers\Image;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends BaseController
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'update' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s', strtotime($model->date));
            if (isset($_FILES)) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image && $model->validate(['image'])){
                    $model->image = Image::upload($model->image, 'news');
                } else {
                    $model->image = '';
                }
            }
            if ($model->save()) {
                return $this->redirectAfterSave($model->id);
            } else {
                return $this->refresh();
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->date = date('Y-m-d H:i:s', strtotime($model->date));
            if (isset($_FILES)) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image && $model->validate(['image'])){
                    $model->image = Image::upload($model->image, 'news');
                }
                else{
                    $model->image = $model->oldAttributes['image'];
                }
            }

            $model->save();

            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRemoveImage($id)
    {
        $model = News::findOne($id);

        if($model === null){
            //$this->flash('error', 'Not found');
        }
        else{
            $model->image = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$model->image);
//                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
//                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->redirectAfterSave($model->id);
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
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
