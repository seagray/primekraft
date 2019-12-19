<?php

use yii\db\Migration;

class m170814_085906_add_ozon_url_to_product extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'ozon_url', $this->string(512));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'ozon_url');
    }
}
