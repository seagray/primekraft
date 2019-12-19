<?php

use yii\db\Migration;

class m160720_115321_add_office_field_in_address extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%address}}', 'office', $this->boolean()->defaultValue(0)->comment('Адрес офиса'));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%address}}', 'office');
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
