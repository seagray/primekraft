<?php

use yii\db\Migration;

class m161216_120720_set_referrer_to_all_free_user extends Migration
{
    public function safeUp()
    {
        $promoCode = 'ADMIN';
        $discount = (new \yii\db\Query())->select(['user_id'])->from('discount')->where(['code' => $promoCode])->one();
        if (!empty($discount)) {
            $this->update('vacancy', ['referrer_id' => $discount['user_id']], ['referrer_id' => null]);
            $this->update('user', ['referrer_id' => $discount['user_id']], ['referrer_id' => null, 'role' => 'agent']);
        } else {
            echo 'Discount with code "' . $promoCode .'" not exists';
        }
    }

    public function safeDown()
    {
        $promoCode = 'ADMIN';
        $discount = (new \yii\db\Query())->select(['user_id'])->from('discount')->where(['code' => $promoCode])->one();
        if (!empty($discount)) {
            $this->update('vacancy', ['referrer_id' => null], ['referrer_id' => $discount['user_id']]);
            $this->update('user', ['referrer_id' => null], ['referrer_id' => $discount['user_id']]);
        } else {
            echo 'Discount with code "' . $promoCode .'" not exists';
        }
    }
}
