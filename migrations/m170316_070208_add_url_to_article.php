<?php

use yii\db\Migration;

class m170316_070208_add_url_to_article extends Migration
{
    const TABLE_NAME = '{{%article}}';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE_NAME, 'url', $this->string()->unique());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE_NAME, 'url');
    }
}