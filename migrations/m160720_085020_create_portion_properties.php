<?php

use yii\db\Migration;

class m160720_085020_create_portion_properties extends Migration
{
    public function up()
    {
        $this->createTable('{{%portion_properties}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название'),
            'value' => $this->string(255)->notNull()->comment('Значение'),
            'value_per_100' => $this->string(255)->notNull()->comment('Значение на 100 гр'),
            'ord' => $this->boolean()->notNull()->comment('Сортировка')->defaultValue(0),
            'public' => $this->boolean()->notNull()->comment('Опубликовано')->defaultValue(0),
            'portion_id' => $this->integer()->notNull()->comment('Порция'),
        ]);

        $this->addForeignKey('portion', '{{%portion_properties}}', 'portion_id', '{{%portion}}', 'id');
    }

    public function down()
    {
        echo "m160720_085020_create_portion_properties cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
