<?php

use yii\db\Migration;

class m160816_154719_add_column_city extends Migration
{
    public function up()
    {
        $this->addColumn('address', 'city_id', $this->integer());

        $q = $this->db->createCommand("SELECT id FROM city WHERE name='Санкт-Петербург'")->query();
        $spb_id = (int)$q->readColumn(0);
        $this->update('address', ['city_id' => $spb_id]);
    }

    public function down()
    {
        $this->dropColumn('address', 'city_id');
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
