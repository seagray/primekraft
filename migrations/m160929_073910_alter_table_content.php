<?php

use yii\db\Migration;

class m160929_073910_alter_table_content extends Migration
{
    public function up()
    {
        $this->renameColumn('content_block', 'content', 'text');
    }

    public function down()
    {
        $this->renameColumn('content_block', 'text', 'content');
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
