<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "address".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $description
 * @property string $phones
 * @property string $email
 * @property string $website
 * @property integer $public
 * @property float $latitude;
 * @property float $longitude;
 * @property boolean $office;
 * @property integer $city_id
 *
 * @property City $city
 */
class Address extends \yii\db\ActiveRecord
{
    public function init()
    {
        $this->office = 0;
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'description', 'latitude', 'longitude'], 'required'],
            [['phones', 'email', 'website'], 'safe'],
            [['public', 'office', 'city_id'], 'integer'],
            [['name', 'address', 'description', 'phones', 'email', 'website'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['latitude', 'longitude'], 'number'],
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
            'city_id' => 'Город',
            'address' => 'Адрес',
            'description' => 'Описание',
            'phones' => 'Телефоны',
            'email' => 'E-mail',
            'website' => 'Веб-сайт',
            'public' => 'Опубликован',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'office' => 'Главный офис'
        ];
    }

    public function getPhoneNumber()
    {
        return preg_replace('([^+\d])', '', $this->phones);
    }

    /**
     * @return Address
     */
    public static function getOffice()
    {
        static $office;
        if (!isset($office)) {
            if (!$office = self::find()->where(['office' => 1])->one()) {
                $office = new self;
            }
        }
        return $office;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
