<?php

use yii\db\Migration;

class m170822_121954_add_column_ulmart_url_to_product extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'ulmart_url', $this->string(512));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'ulmart_url');
    }
}
