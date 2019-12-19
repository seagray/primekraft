<?php

namespace app\models;

use yii;

use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property string $name
 * @property double $latitude
 * @property double $longitude
 * @property integer $public
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'latitude', 'longitude'], 'required'],
            [['latitude', 'longitude', 'public'], 'number'],
            [['name'], 'string', 'max' => 255],
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
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'public' => 'Опубликован'
        ];
    }

    public function getDistricts()
    {
        return CityObjects::find()->where(['public' => 1, 'type' => 1, 'city_id' => $this->id])->orderBy('name ASC')->all();
    }

    public function getSubways()
    {
        return CityObjects::find()->where(['public' => 1, 'type' => 2, 'city_id' => $this->id])->orderBy('name ASC')->all();
    }

    public static function getList()
    {
        return ArrayHelper::map(static::find()->all(), 'id', 'name');
    }

    public static function getAllPublicList()
    {
        return ArrayHelper::map(static::findAll(['public' => 1]), 'id', 'name');
    }
}
