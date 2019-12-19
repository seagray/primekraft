<?php

use yii\db\Migration;

class m170912_101233_add_external_urls_http_ok extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'ozon_url_http_ok', $this->boolean()->defaultValue(true));
        $this->addColumn('{{%product}}', 'ulmart_url_http_ok', $this->boolean()->defaultValue(true));
        $this->addColumn('{{%product}}', 'wildberries_url_http_ok', $this->boolean()->defaultValue(true));
    }

    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'ozon_url_http_ok');
        $this->dropColumn('{{%product}}', 'ulmart_url_http_ok');
        $this->dropColumn('{{%product}}', 'wildberries_url_http_ok');
    }
}
