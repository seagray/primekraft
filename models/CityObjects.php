<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city_objects".
 *
 * @property integer $id
 * @property string $name
 * @property double $latitude
 * @property double $longitude
 * @property integer $city_id
 *
 * @property integer $type
 * @property integer $public
 *
 * @property City $city
 */
class CityObjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city_objects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'latitude', 'longitude', 'city_id'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['city_id', 'type', 'public'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
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
            'city_id' => 'Город',
            'type' => 'Тип',
            'public' => 'Опубликован'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    public function getTypeLabel()
    {
        return static::$typeList[$this->type];
    }

    static $typeList = [
        1 => 'Район',
        2 => 'Метро'
    ];
}
