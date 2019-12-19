<?php

use yii\db\Migration;

class m161117_112633_create_invoice extends Migration
{
    public function safeUp()
    {
        $this->createTable('invoice', [
            'id' => $this->primaryKey(),
            'created' => $this->dateTime()->notNull(),
            'expires' => $this->integer(),
            'sum' => $this->float(),
            'status' => $this->integer(),
            'closed'  => $this->dateTime()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('invoice');
        return true;
    }
}
