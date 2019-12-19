<?php

use yii\db\Migration;

class m160719_172105_portion_weigth_float extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%portion}}', 'portion_weight', $this->float()->notNull());
    }

    public function down()
    {
        echo "m160719_172105_portion_weigth_float cannot be reverted.\n";

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
