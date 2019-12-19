<?php

use yii\db\Migration;

class m161110_145228_add_columns_social_profiles_to_vacancy_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('vacancy', 'vk_profile', $this->string(255));
        $this->addColumn('vacancy', 'instagram_profile', $this->string(255));
        $this->addColumn('vacancy', 'youtube_profile', $this->string(255));
    }

    public function safeDown()
    {
        $this->dropColumn('vacancy', 'vk_profile');
        $this->dropColumn('vacancy', 'instagram_profile');
        $this->dropColumn('vacancy', 'youtube_profile');
    }
}
