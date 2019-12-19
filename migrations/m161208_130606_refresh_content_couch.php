<?php

use yii\db\Migration;

class m161208_130606_refresh_content_couch extends Migration
{
    public function up()
    {
        $this->delete("content_block", ["name" => "couch.text"]);
    }

    public function down()
    {
    }
}
