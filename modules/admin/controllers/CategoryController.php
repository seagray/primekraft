<?php

namespace app\modules\admin\controllers;

use app\models\CatalogueTags2Category;
use yii;
use app\models\Category;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\helpers\Image;
use yii\web\UploadedFile;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CategoryController extends BaseController
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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Category::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (isset($_FILES)) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image && $model->validate(['image'])){
                    $model->image = Image::upload($model->image, 'category');
                } else{
                    $model->image = '';
                }
            }
            if ($model->save()) {
                $this->saveGroups($model);

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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES)) {
                $model->image = UploadedFile::getInstance($model, 'image');
                if($model->image && $model->validate(['image'])){
                    $model->image = Image::upload($model->image, 'category');
                }
                else{
                    $model->image = $model->oldAttributes['image'];
                }
            }

            if ($model->save()) {
                $this->saveGroups($model);
            }

            return $this->redirectAfterSave($model->id);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRemoveImage($id)
    {
        $model = Category::findOne($id);

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

    protected function saveGroups(yii\db\ActiveRecord $model)
    {
        CatalogueTags2Category::deleteAll(['category_id' => $model->id]);

        foreach (ArrayHelper::getValue(Yii::$app->request->post((new \ReflectionClass($model))->getShortName()), 'groups', []) as $groupId) {
            $link = new CatalogueTags2Category();
            $link->tag_id = $groupId;
            $link->category_id = $model->id;
            $link->save();
        }
    }
}
