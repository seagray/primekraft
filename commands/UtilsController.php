<?php
namespace app\commands;

use app\models\Product;
use yii\console\Controller;
use yii\web\NotFoundHttpException;

class UtilsController extends Controller
{
    public function actionCheckProductExternalUrls()
    {
        /** @var Product $product */
        foreach (Product::find()->all() as $product) {
            $product->checkUrls()->save();
        }
    }

    public function actionCheckProductUrl($productId)
    {
        if (!$product = Product::findOne($productId)) {
            throw new NotFoundHttpException();
        }

        $product->checkUrls()->save();
    }
}
