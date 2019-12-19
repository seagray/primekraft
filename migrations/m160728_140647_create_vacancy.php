<?php

use yii\db\Migration;

/**
 * Handles the creation for table `vacancy`.
 */
class m160728_140647_create_vacancy extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vacancy', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100),
            'phone' => $this->string(30),
            'email' => $this->string(255),
            'file' => $this->string(255),
            'comment' => $this->text(),
            'dt' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vacancy');
    }
}
