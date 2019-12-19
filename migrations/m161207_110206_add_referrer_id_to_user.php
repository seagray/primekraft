<?php

use yii\db\Migration;

class m161207_110206_add_referrer_id_to_user extends Migration
{
    public function safeUp()
    {
        $this->addColumn('user', 'referrer_id', $this->integer()->null());
        $this->addColumn('vacancy', 'referrer_id', $this->integer()->null());
    }

    public function safeDown()
    {
        $this->dropColumn('vacancy', 'referrer_id');
        $this->dropColumn('user', 'referrer_id');
        return true;
    }
}