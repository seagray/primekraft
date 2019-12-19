<?php

use yii\db\Migration;

/**
 * Handles the creation for table `discount_value`.
 */
class m160920_134543_create_discount_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('discount_value', [
            'id' => $this->primaryKey(),
            'discount_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'percent' => $this->float()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('discount_value');
    }
}
