<?php

use yii\db\Migration;

class m161122_125044_seo_ignite_table_create extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%seo_ignite}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(4096)->notNull(),

            'title' => $this->string(),
            'description' => $this->text(),
            'keywords' => $this->text(),
            'h1' => $this->string(),

            'og_url' => $this->text(),
            'og_type' => $this->string(),
            'og_site_name' => $this->string(),
            'og_title' => $this->string(),
            'og_description' => $this->text(),
            'og_image' => $this->text(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%seo_ignite}}');
        return true;
    }
}
