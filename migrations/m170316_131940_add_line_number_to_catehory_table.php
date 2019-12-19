<?php

use yii\db\Migration;

class m170316_131940_add_line_number_to_catehory_table extends Migration
{
    public function up()
    {
        $this->addColumn('category', 'lineNumberOnMainPage', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('category', 'lineNumberOnMainPage');
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
