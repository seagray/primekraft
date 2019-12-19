<?php

use yii\db\Migration;

/**
 * Handles the creation for table `transaction`.
 */
class m160920_134717_create_transaction_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'date' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'direction' => $this->integer(1)->notNull(),
            'sum' => $this->decimal(16, 2)->notNull(),
            'order_id' => $this->integer()->notNull(),
            'payout_id' => $this->integer()->notNull(),
            'comment' => $this->string(255)->null()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('transaction');
    }
}
