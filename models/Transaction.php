<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "transaction".
 * @property integer $user_id
 * @property string $date
 * @property integer $direction
 * @property float $sum
 * @property integer $order_id
 * @property integer $payout_id
 * @property string $comment
 *
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
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
            'order_id' => 'Номер заказа',
            'date' => 'Дата',
            'sum' => 'Сумма'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
