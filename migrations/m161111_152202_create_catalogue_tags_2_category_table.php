<?php

use yii\db\Migration;

/**
 * Handles the creation for table `catalogue_tags_2_category`.
 */
class m161111_152202_create_catalogue_tags_2_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('catalogue_tags_2_category', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(),
            'tag_id' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalogue_tags_2_category');
    }
}
