<?php

use yii\db\Migration;

/**
 * Handles the creation for table `order_status`.
 */
class m160920_134617_create_order_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('order_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'code' => $this->string(100)->notNull(),
        ]);

        $this->insert('order_status', ['id' => 1, 'name' => 'Новый', 'code' => 'new']);
        $this->insert('order_status', ['id' => 2, 'name' => 'Обработан.Ожидает отправки', 'code' => 'worked']);
        $this->insert('order_status', ['id' => 3, 'name' => 'Отправлен', 'code' => 'tracking']);
        $this->insert('order_status', ['id' => 4, 'name' => 'Выполнен', 'code' => 'delivered']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('order_status');
    }
}
