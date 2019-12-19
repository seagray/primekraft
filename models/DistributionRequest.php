<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distribution_request".
 *
 * @property integer $id
 * @property string $phone
 * @property string $email
 * @property string $city
 * @property string $obj
 * @property string $shop
 * @property string $company
 * @property string $message
 * @property string $dt
 */
class DistributionRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'distribution_request';
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->dt = date('Y-m-d H:i:s');
        }
        return parent::beforeSave($insert);
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message'], 'string'],
            [['phone'], 'string', 'max' => 30],
            [['email', 'city', 'obj', 'shop', 'company'], 'string', 'max' => 255],
            [['city', 'obj', 'phone', 'message'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Телефон',
            'email' => 'Email',
            'message' => 'Сообщение',
            'dt' => 'Дата создания',
            'city' => 'Город',
            'obj' => 'Форма собственности',
            'shop' => 'Магазин',
            'company' => 'Компания',
        ];
    }
}
