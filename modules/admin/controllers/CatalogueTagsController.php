<?php

namespace app\modules\admin\controllers;

use app\models\CatalogueTags2Category;
use Yii;
use app\models\CatalogueTags;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CatalogueTagsController implements the CRUD actions for CatalogueTags model.
 */
class CatalogueTagsController extends BaseController
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
     * Lists all CatalogueTags models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CatalogueTags::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CatalogueTags model.
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
     * Creates a new CatalogueTags model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogueTags();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveCategories($model);
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    private function saveCategories(ActiveRecord $model) {
        CatalogueTags2Category::deleteAll(['tag_id' => $model->id]);
        foreach (ArrayHelper::getValue(Yii::$app->request->post((new \ReflectionClass($model))->getShortName()), 'categories', []) as $categoryId) {
            $link = new CatalogueTags2Category();
            $link->category_id = $categoryId;
            $link->tag_id = $model->id;
            $link->save();
        }
    }

    /**
     * Updates an existing CatalogueTags model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveCategories($model);
            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CatalogueTags model.
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
     * Finds the CatalogueTags model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogueTags the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogueTags::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
