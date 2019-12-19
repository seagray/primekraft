<?php

use yii\db\Migration;

class m160720_144719_add_contacts_additional_info extends Migration
{
    public function up()
    {
        $this->insert('{{%content_block}}', [
            'title' => 'Дополнительная контактная информация',
            'name' => 'contacts_additional_info',
            'content' => '',
        ]);
    }

    public function down()
    {
        echo "m160720_144719_add_contacts_additional_info cannot be reverted.\n";

        return false;
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
