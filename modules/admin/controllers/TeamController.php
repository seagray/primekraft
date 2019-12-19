<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Team;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\helpers\Image;
use yii\web\UploadedFile;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends BaseController
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
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Team::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Team model.
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
     * Creates a new Team model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Team();

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES)) {
                $model->photo = UploadedFile::getInstance($model, 'photo');
                if($model->photo && $model->validate(['photo'])){
                    $model->photo = Image::upload($model->photo, 'team');
                }
                else{
                    $model->photo = '';
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
     * Updates an existing Team model.
     * If update is successful, the browser will be redirected to the 'update' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES)) {
                $model->photo = UploadedFile::getInstance($model, 'photo');
                if($model->photo && $model->validate(['photo'])){
                    $model->photo = Image::upload($model->photo, 'team');
                }
                else{
                    $model->photo = $model->oldAttributes['photo'];
                }
            }

            $model->save();
            return $this->refresh();
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Team model.
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
        $model = Team::findOne($id);

        if ($model === null) {
            //$this->flash('error', 'Not found');
        } else {
            $model->photo = '';
            if ($model->update()) {
                @unlink(Yii::getAlias('@webroot') . $model->photo);
//                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
//                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->redirectAfterSave($model->id);
    }

    /**
     * Finds the Team model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Team the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Team::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
