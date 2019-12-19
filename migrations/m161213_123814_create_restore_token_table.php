<?php

use yii\db\Migration;

/**
 * Handles the creation for table `restore_token`.
 */
class m161213_123814_create_restore_token_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('restore_token', [
            'id' => $this->primaryKey(),
            'created' => $this->dateTime()->notNull(),
            'token' => $this->string(32)->unique()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('restore_token');

        return true;
    }
}
