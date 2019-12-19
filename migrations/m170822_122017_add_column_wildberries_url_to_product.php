<?php

use yii\db\Migration;

class m170822_122017_add_column_wildberries_url_to_product extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'wildberries_url', $this->string(512));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'wildberries_url');
    }
}
