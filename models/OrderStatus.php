<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "order_status".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $sort
 *
 */
class OrderStatus extends \yii\db\ActiveRecord
{
    const STATUS_CODE_NEW = 'new';
    const STATUS_CODE_WORK = 'worked';
    const STATUS_CODE_TRACK = 'tracking';
    const STATUS_CODE_COMPLETE = 'delivered';
    const STATUS_CODE_REJECT = 'rejected';

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_status';
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
            'name' => 'Статус',
            'code' => 'Код',
        ];
    }
}
