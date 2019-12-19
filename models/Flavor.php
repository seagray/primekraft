<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "flavor".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_small
 * @property string $image
 * @property string $slug
 *
 * @property string $hash
 * @property Portion[] $productFlavors
 * @property Product[] $products
 */
class Flavor extends yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'flavor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name_small'], 'safe'],
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'name_small' => 'Дополнительное название',
            'image' => 'Изображение',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$insert && $this->image != $this->oldAttributes['image'] && $this->oldAttributes['image']){
                @unlink(Yii::getAlias('@webroot').$this->oldAttributes['image']);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFlavors()
    {
        return $this->hasMany(Portion::className(), ['flavor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_flavor', ['flavor_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getHash()
    {
        if ($this->slug)
        {
            return $this->slug;
        } else {
            return sprintf("taste_%s", $this->id);
        }
    }
}
