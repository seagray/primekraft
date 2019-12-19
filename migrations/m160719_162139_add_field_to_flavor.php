<?php

use yii\db\Migration;

class m160719_162139_add_field_to_flavor extends Migration
{
    public function up()
    {
        $this->addColumn('{{%flavor}}', 'name_small', $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('{{%flavor}}', 'name_small');
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
