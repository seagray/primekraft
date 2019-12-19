<?php

use yii\db\Migration;

/**
 * Handles the creation for table `payout`.
 */
class m160920_134653_create_payout_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('payout', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'status' => $this->boolean()->notNull(),
            'sum' => $this->decimal(16, 2)->notNull(),
            'date' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('payout');
    }
}
