<?php

use yii\db\Migration;

/**
 * Handles the creation for table `order_content`.
 */
class m160920_134608_create_order_content_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('order_content', [
            'id' => $this->primaryKey(),
            'order_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'price' => $this->decimal(16, 2)->notNull(),
            'price_discount' => $this->decimal(16, 2),
            'count' => $this->integer()->notNull()->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('order_content');
    }
}
