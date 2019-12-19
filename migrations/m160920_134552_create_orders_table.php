<?php

use yii\db\Migration;

/**
 * Handles the creation for table `orders`.
 */
class m160920_134552_create_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'fio' => $this->string(255)->notNull(),
            'phone' => $this->string(100)->notNull(),
            'email' => $this->string(100)->notNull(),
            'address' => $this->string(255)->notNull(),
            'comment' => $this->text()->null(),
            'discount_id' => $this->integer()->null(),
            'status_id' => $this->integer()->notNull(),
            'sum' => $this->decimal(16, 2)->notNull(),
            'discount' => $this->decimal(16, 2)->notNull(),
            'date' => $this->dateTime()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
