<?php

namespace app\modules\admin\controllers;

use yii;
use app\models\Product;
use yii\data\ActiveDataProvider;
use app\modules\admin\components\BaseController;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\helpers\Image;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends BaseController
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Product::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
        $model = new Product();

        if ($model->load(Yii::$app->request->post())) {
            if (isset($_FILES)) {
                $model->images = UploadedFile::getInstances($model, 'images');

                $images = [];
                foreach ($model->images as $img) {
                    $images[] = Image::upload($img, 'product');
                }
                $model->images = json_encode(array_values($images));
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
                $model->images = UploadedFile::getInstances($model, 'images');

                $images = [];
                foreach ($model->images as $i => $img) {
                    $images[] = Image::upload($img, 'product');
                }
                $oldImages = $model->oldAttributes['images'];
                if ($oldImages) {
                    $oldImages = json_decode($oldImages, true);
                    $images = array_merge($oldImages, $images);
                }
                $model->images =  json_encode(array_values($images));
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
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRemoveImage($id, $url)
    {
        $model = Product::findOne($id);


        if($model && $model->images) {
            $images = json_decode($model->images, true);

            if (!$images) {
                return $this->redirectAfterSave($model->id);
            }
            foreach ($images as $i => $image) {
                if ($image == $url) {
                    @unlink(Yii::getAlias('@webroot') . $image);
                    unset($images[$i]);
                    break;
                }
            }
            $model->images = json_encode(array_values($images));
            $model->save();
        }
        return $this->redirectAfterSave($model->id);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionCheckLinks()
    {
        $total = Product::find()->count();
        $offset = \Yii::$app->request->get('offset', 0);
        $limit = 5;

        if ($offset >= $total) {
            return $this->redirect(['index']);
        }

        /** @var Product $product */
        foreach (Product::find()->limit($limit)->offset($offset)->all() as $product) {
            $product->checkUrls()->save();
        }

        return $this->redirect(['check-links', 'offset' => $offset + $limit]);
    }
}
