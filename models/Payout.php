<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "payout".
 * @property integer $status
 * @property integer $user_id
 * @property float $sum
 * @property string $date
 *
 * @property User $user
 */
class Payout extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payout';
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
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'sum' => 'Сумма',
            'date' => 'Дата',
        ];
    }

    public static function findStatusText($status)
    {
        $texts = [
            0 => 'Новая',
            1 => 'Выполнена',
            2 => "Отказано"
        ];
        return $texts[$status];
    }

    public function getStatusText()
    {
        return static::findStatusText($this->status);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
