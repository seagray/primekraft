<?php

use yii\db\Migration;

class m160719_170801_add_id_to_portion extends Migration
{
    public function safeUp()
    {
        $this->dropPrimaryKey('id', '{{%portion}}');

        $this->addColumn('{{%portion}}', 'id', $this->primaryKey());
    }

    public function safeDown()
    {
        echo "m160719_170801_add_id_to_portion cannot be reverted.\n";

        return false;
    }
}
