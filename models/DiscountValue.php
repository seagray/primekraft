<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "discount_value".
 *
 * @property integer $discount_id
 * @property integer $product_id
 * @property float $percent
 *
 */
class DiscountValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }


    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
