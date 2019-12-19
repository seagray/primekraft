<?php

use yii\db\Migration;

class m161116_124008_add_payment_on_delivery_to_order extends Migration
{
    public function safeUp()
    {
        $this->addColumn('orders', 'payment_on_delivery', $this->boolean()->defaultValue(false));
    }

    public function safeDown()
    {
        $this->dropColumn('orders', 'payment_on_delivery');
        return true;
    }
}
