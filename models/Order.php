<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "orders".
 * @property
 * @property OrderContent[] $content
 * @property integer $status_id
 * @property string $email
 * @property float $delivery_cost
 * @property float $sum
 * @property float $payment_status
 * @property integer $invoice_id
 * @property boolean payment_on_delivery
 *
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'fio', 'sum', 'phone', 'address'], 'required'],
            [['email'], 'email'],
            [['fio', 'address', 'phone'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'createDate' => 'Дата и время заказа',
            'fio' => 'ФИО',
            'phone' => 'Телефон',
            'email' => 'Email',
            'address' => 'Адрес',
            'comment' => 'Комментарий',
            'sum' => 'Сумма',
            'discount' => 'Сумма скидки',
            'delivery_cost' => "Стоимость доставки",
            "payment_on_delivery" => "Оплата при получении",
            'status_id' => "Статус"
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discount::className(), ['id' => 'discount_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(OrderStatus::className(), ['id' => 'status_id']);
    }

    /**
     * @return OrderContent[]
     */
    public function getContent()
    {
        return $this->hasMany(OrderContent::className(), ['order_id' => 'id']);
    }

    public function getCreateDate()
    {
        return (new \DateTime($this->date))->format('d.m.Y H:i');
    }
}
