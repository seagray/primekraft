<?php

use yii\db\Migration;

class m161117_123843_add_invoice_id_to_order extends Migration
{
    public function safeUp()
    {
        $this->addColumn('orders', 'invoice_id', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('orders', 'invoice_id');
        return true;
    }
}