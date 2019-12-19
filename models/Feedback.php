<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "feedback".
 *
 * @property integer $id
 * @property string $phone
 * @property string $email
 * @property string $message
 * @property string $dt
 */
class Feedback extends yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
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
            [['phone', 'message'], 'required'],
            [['message'], 'string'],
            [['phone'], 'string', 'max' => 30],
            [['email'], 'email'],
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
            'dt' => 'Дата создания'
        ];
    }
}
