<?php

use yii\db\Migration;

class m160920_152730_alter_user_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'role', $this->string(50)->notNull()->defaultValue('admin'));
        $this->addColumn('user', 'hold', $this->decimal(16, 2)->notNull()->defaultValue(0));
        $this->addColumn('user', 'pay', $this->decimal(10, 0)->notNull()->defaultValue(0));
        $this->addColumn('user', 'payout', $this->decimal(16, 2)->notNull()->defaultValue(0));
        $this->addColumn('user', 'is_code', $this->boolean()->notNull()->defaultValue(false));
        $this->addColumn('user', 'nickname', $this->string(255)->notNull()->defaultValue('Unknown'));

        $this->alterColumn('user', 'role', $this->string(50)->notNull());
    }

    public function safeDown()
    {
        $this->dropColumn('user', 'role');
        $this->dropColumn('user', 'hold');
        $this->dropColumn('user', 'pay');
        $this->dropColumn('user', 'payout');
        $this->dropColumn('user', 'is_code');
        $this->dropColumn('user', 'nickname');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
