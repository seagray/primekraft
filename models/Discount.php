<?php

namespace app\models;

use yii;

/**
 * This is the model class for table "discount".
 * @property integer $id
 * @property string $code
 * @property string $lifetime
 * @property integer $user_id
 * @property string $date
 * @property integer $cookie_expire
 *
 */
class Discount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discount';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['code', 'unique'],
            ['cookie_expire', 'default', 'value' => static::getDefaultCookieExpire(true)]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'lifetime' => 'Годен до',
            'user_id' => 'Партнер',
            'date' => 'Дата создания',
            'cookie_expire' => 'Срок хранения cookies с кодом',
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getValues()
    {
        return $this->hasMany(DiscountValue::className(), ['discount_id' => 'id']);
    }

    public static function getDefaultCookieExpire($in_days = false)
    {
        $result = \Yii::$app->params['defaultReferralCodeCookieExpire'];
        if ($in_days) {
            return $result;
        }
        return $result * 24 * 60 * 60;
    }

    public function getCookieExpireTime()
    {
        return time() + (($this->cookie_expire != null) && ($this->cookie_expire > 0)
            ? ($this->cookie_expire * 24 * 60 * 60) : static::getDefaultCookieExpire());
    }

    public static function setPromo($promoCode)
    {
        $discount = self::findOne(['code' => mb_strtoupper($promoCode)]);
        if (!empty($discount) && (!$discount->lifetime || strtotime($discount->lifetime) >= time())) {
            \Yii::$app->response->cookies->add(new \yii\web\Cookie([
                'name' => 'promoCode',
                'value' => $promoCode,
                'expire' => $discount->getCookieExpireTime()
            ]));
        }
    }

    public static function getPromo()
    {
        $promoCode = false;
        if (isset(Yii::$app->request->cookies['promoCode'])) {
            $promoCode = Yii::$app->request->cookies['promoCode'];
            $discount = Discount::findOne(['code' => mb_strtoupper($promoCode)]);
            if (empty($discount) || ($discount->lifetime && strtotime($discount->lifetime) < time())) {
                $promoCode = false;
            }
        }

        return $promoCode;
    }
}
