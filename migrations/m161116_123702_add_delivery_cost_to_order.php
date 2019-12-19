<?php

use yii\db\Migration;

class m161116_123702_add_delivery_cost_to_order extends Migration
{
    public function safeUp()
    {
        $this->addColumn('orders', 'delivery_cost', $this->float(2)->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('orders', 'delivery_cost');
    }
}
