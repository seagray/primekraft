<?php

use yii\db\Migration;

/**
 * Handles the creation for table `discount`.
 */
class m160920_134447_create_discount_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('discount', [
            'id' => $this->primaryKey(),
            'code' => $this->string(100)->notNull(),
            'lifetime' => $this->dateTime()->null(),
            'user_id' => $this->integer(),
            'is_order' => $this->boolean(),
            'date' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('discount');
    }
}
