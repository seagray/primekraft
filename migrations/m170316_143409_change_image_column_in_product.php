<?php

use app\models\Product;
use yii\db\Migration;

class m170316_143409_change_image_column_in_product extends Migration
{
    const TABLE_NAME = '{{%product}}';

    public function safeUp()
    {
        $this->addColumn(self::TABLE_NAME, 'images', $this->text()->null());

        $products = Product::find()->all();

        foreach ($products as $product) {
            if(isset($product->image) && $product->image) {
                $product->images = json_encode([$product->image]);
                $product->save();
            }
        }

        $this->dropColumn(self::TABLE_NAME, 'image');
    }

    public function safeDown()
    {
        $this->addColumn(self::TABLE_NAME, 'image', $this->string()->null());

        $products = Product::find()->all();

        foreach ($products as $product) {
            if(isset($product->images) && $product->images) {
                $images = json_decode($product->images, true);
                $product->image = array_shift($images);
                $product->save();
            }
        }

        $this->dropColumn(self::TABLE_NAME, 'images');
    }
}
