<?php

use yii\db\Migration;

class m170213_131352_create_article_table extends Migration
{
    const TABLE_NAME = '{{%article}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'date' => $this->dateTime()->notNull(),
            'text' => $this->text()->null(),
            'announce' => $this->text()->null(),
            'image' => $this->text()->null(),
            'public' => $this->boolean()->defaultValue(false)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}
