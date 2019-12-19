<?php

use yii\db\Migration;

/**
 * Handles the creation for table `distribution_request`.
 */
class m160929_104455_create_distribution_request_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('distribution_request', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(30),
            'email' => $this->string(255),
            'city' => $this->string(255),
            'obj' => $this->string(255),
            'shop' => $this->string(255),
            'company' => $this->string(255),
            'message' => $this->text(),
            'dt' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('distribution_request');
    }
}
