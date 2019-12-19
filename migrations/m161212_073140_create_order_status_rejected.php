<?php

use yii\db\Migration;

class m161212_073140_create_order_status_rejected extends Migration
{
    public function safeUp()
    {
        $this->insert('order_status', ['id' => 5, 'name' => 'Отменен', 'code' => 'rejected']);

        $this->addColumn('order_status', 'sort', $this->integer()->null());
        $this->update('order_status', ['sort' => 1], ['code' => 'new']);
        $this->update('order_status', ['sort' => 2], ['code' => 'worked']);
        $this->update('order_status', ['sort' => 3], ['code' => 'tracking']);
        $this->update('order_status', ['sort' => 4], ['code' => 'delivered']);
        $this->update('order_status', ['sort' => 5], ['code' => 'rejected']);
    }

    public function safeDown()
    {
        $this->dropColumn('order_status', 'sort');

        $this->delete('order_status', ['code' => 'rejected']);

        return true;
    }
}