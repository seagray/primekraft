<?php

use yii\db\Migration;

class m161208_092936_seo_ignite_img_table_create extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%seo_ignite_img}}', [
            'id' => $this->primaryKey(),

            'src' => $this->string(4096)->notNull(),

            'alt' => $this->text(),
            'title' => $this->text()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%seo_ignite_img}}');
        return true;
    }
}
