<?php

use yii\db\Migration;

/**
 * Handles the creation for table `feedback`.
 */
class m160728_140630_create_feedback extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('feedback', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(30),
            'email' => $this->string(255),
            'message' => $this->text(),
            'dt' => $this->dateTime()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('feedback');
    }
}
