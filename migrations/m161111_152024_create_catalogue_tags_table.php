<?php

use yii\db\Migration;

/**
 * Handles the creation for table `catalogue_tags`.
 */
class m161111_152024_create_catalogue_tags_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('catalogue_tags', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'slug' => $this->string(255),
            'hidden' => $this->boolean(),
            'text' => $this->text(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('catalogue_tags');
    }
}
