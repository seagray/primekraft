<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "portion".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $flavor_id
 * @property integer $portion_weight
 * @property string $description
 * @property double $energy
 * @property double $protein
 * @property double $fat
 * @property double $carbs
 * @property double $energy_per_100
 * @property double $protein_per_100
 * @property double $fat_per_100
 * @property double $carbs_per_100
 *
 * @property Flavor $flavor
 * @property Product $product
 * @property PortionProperties[] $properties
 */
class Portion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'portion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'flavor_id', 'portion_weight'], 'required'],
            [['product_id', 'flavor_id'], 'integer'],
            [['description'], 'string'],
            [['energy', 'protein', 'fat', 'carbs', 'energy_per_100', 'protein_per_100', 'fat_per_100', 'carbs_per_100', 'portion_weight'], 'number'],
            [['flavor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Flavor::className(), 'targetAttribute' => ['flavor_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Товар',
            'flavor_id' => 'Вкус',
            'portion_weight' => 'Вес',
            'description' => 'Состав',
            'energy' => 'Калории',
            'protein' => 'Белки',
            'fat' => 'Жиры',
            'carbs' => 'Углеводы',
            'energy_per_100' => 'Калории на 100 гр',
            'protein_per_100' => 'Белки на 100 гр',
            'fat_per_100' => 'Жиры на 100 гр',
            'carbs_per_100' => 'Углеводы на 100 гр',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFlavor()
    {
        return $this->hasOne(Flavor::className(), ['id' => 'flavor_id']);
    }

    /**
     * @return string
     */
    public function getFlavorName()
    {
        return $this->getFlavor()->one()->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->getProduct()->one()->name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return "{$this->product->category->name}/{$this->getProductName()} - {$this->getFlavorName()}";
    }

    /**
     * @return array
     */
    public static function getList()
    {
        $list = [];
        /* @var $portion Portion */
        foreach (self::find()->all() as $portion) {
            $list[$portion->id] = $portion->getName();
        }
        return $list;
    }

    /**
     * @return PortionProperties[]
     */
    public function getProperties()
    {
        return PortionProperties::find()->where(['public' => 1, 'portion_id' => $this->id])->orderBy('ord ASC')->all();
    }
}
