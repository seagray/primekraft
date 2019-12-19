<?php

use yii\db\Migration;

class m161209_115258_add_cookie_expire_to_discount extends Migration
{
    public function safeUp()
    {
        $this->addColumn('discount', 'cookie_expire', $this->integer()->defaultValue(14)->null());
    }

    public function safeDown()
    {
        $this->dropColumn('discount', 'cookie_expire');
        return true;
    }
}
