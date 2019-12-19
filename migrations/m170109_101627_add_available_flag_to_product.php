<?php

use yii\db\Migration;

class m170109_101627_add_available_flag_to_product extends Migration
{
    public function safeUp()
    {
        $this->addColumn('product', 'available', $this->boolean()->defaultValue(true));
    }

    public function safeDown()
    {
        $this->dropColumn('product', 'available');
        return true;
    }
}
