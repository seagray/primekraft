<?php

use yii\db\Migration;

class m161004_081246_add_slug extends Migration
{
    public function safeUp()
    {
        $this->addColumn('category', 'slug', $this->string(255)->null());
        $this->addColumn('product', 'slug', $this->string(255)->null());
        $this->addColumn('flavor', 'slug', $this->string(255)->null());
    }

    public function safeDown()
    {
        $this->dropColumn('category', 'slug');
        $this->dropColumn('product', 'slug');
        $this->dropColumn('flavor', 'slug');
    }
}
