<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property string $created
 * @property integer $expires
 * @property integer $sum
 * @property integer $status
 * @property string $closed
 */
class Invoice extends \yii\db\ActiveRecord
{
    const STATUS_OPENED = 1;
    const STATUS_EXPIRED = 2;
    const STATUS_FAILED = 3;
    const STATUS_PAID = 4;

    protected static $statusText = [
        self::STATUS_OPENED => 'Открыт',
        self::STATUS_EXPIRED => 'Просрочен',
        self::STATUS_FAILED => 'Отклонен',
        self::STATUS_PAID => 'Оплачен'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created', 'sum', 'status'], 'required'],
            [['expires', 'status'], 'integer'],
            [['sum'], 'number', 'integerOnly' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created' => 'Дата создания',
            'closed' => 'Дата закрытия',
            'expires' => 'Срок платежа',
            'expired' => 'Срок платежа',
            'sum' => 'Сумма',
            'status' => 'Статус',
            'statusText' => 'Статус',
        ];
    }

    public function getStatusText()
    {
        return isset(static::$statusText[$this->status])
            ? static::$statusText[$this->status] : 'Некорректный статус';
    }

    public static function getStatusList()
    {
        return static::$statusText;
    }

    public function getExpired()
    {
        return $this->expires == 0 ? 'Бессрочно' : date('Y-m-d H:i:s', (strtotime($this->created) + $this->expires));
    }
}
