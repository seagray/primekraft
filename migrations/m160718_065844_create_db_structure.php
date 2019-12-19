<?php

use yii\db\Migration;

/**
 * Handles the creation for table `db_structure`.
 */
class m160718_065844_create_db_structure extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tables = Yii::$app->db->schema->getTableNames();
        $dbType = $this->db->driverName;
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";

        /* MYSQL */
        if (!in_array('address', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%address}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'address' => 'VARCHAR(255) NOT NULL',
                    'description' => 'VARCHAR(255) NULL',
                    'phones' => 'VARCHAR(255) NULL',
                    'email' => 'VARCHAR(255) NULL',
                    'website' => 'VARCHAR(255) NULL',
                    'public' => 'TINYINT(1) NULL DEFAULT \'0\'',
                    'latitude' => 'VARCHAR(100) NULL DEFAULT \'0\'',
                    'longitude' => 'VARCHAR(100) NULL DEFAULT \'0\'',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('category', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%category}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'ord' => 'INT(10) UNSIGNED NOT NULL DEFAULT \'0\'',
                    'public' => 'TINYINT(1) UNSIGNED NOT NULL DEFAULT \'1\'',
                    'type' => 'INT(11) NULL DEFAULT \'1\'',
                    'description' => 'TEXT NOT NULL',
                    'image' => 'VARCHAR(255) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('city', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%city}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'latitude' => 'FLOAT NOT NULL',
                    'longitude' => 'FLOAT NOT NULL',
                    'public' => 'TINYINT(4) NULL DEFAULT \'0\'',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('city_objects', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%city_objects}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'latitude' => 'FLOAT NOT NULL',
                    'longitude' => 'FLOAT NOT NULL',
                    'city_id' => 'INT(11) NOT NULL',
                    'type' => 'INT(11) NULL',
                    'public' => 'TINYINT(4) NOT NULL DEFAULT \'0\'',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('content_block', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%content_block}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'title' => 'VARCHAR(255) NOT NULL',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'content' => 'TEXT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('file', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%file}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NULL',
                    'path' => 'VARCHAR(255) NULL',
                    'extension' => 'VARCHAR(255) NULL',
                    'add_time' => 'DATETIME NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('flavor', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%flavor}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'image' => 'VARCHAR(255) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('news', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%news}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'title' => 'VARCHAR(255) NOT NULL',
                    'date' => 'DATETIME NOT NULL',
                    'text' => 'TEXT NOT NULL',
                    'image' => 'VARCHAR(255) NULL',
                    'public' => 'TINYINT(1) NULL DEFAULT \'0\'',
                    'announce' => 'TEXT NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('portion', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%portion}}', [
                    'product_id' => 'INT(11) NOT NULL',
                    0 => 'PRIMARY KEY (`product_id`)',
                    'flavor_id' => 'INT(11) NOT NULL',
                    1 => 'KEY (`flavor_id`)',
                    'portion_weight' => 'INT(11) NOT NULL',
                    'description' => 'TEXT NULL',
                    'energy' => 'FLOAT NULL',
                    'protein' => 'FLOAT NULL',
                    'fat' => 'FLOAT NULL',
                    'carbs' => 'FLOAT NULL',
                    'energy_per_100' => 'FLOAT NULL',
                    'protein_per_100' => 'FLOAT NULL',
                    'fat_per_100' => 'FLOAT NULL',
                    'carbs_per_100' => 'FLOAT NULL',
                    'ord' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('product', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%product}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NULL',
                    'price' => 'FLOAT NOT NULL',
                    'category_id' => 'INT(11) NULL',
                    'portions_count' => 'INT(11) NOT NULL',
                    'weight' => 'INT(11) NOT NULL',
                    'description' => 'TEXT NULL',
                    'image' => 'VARCHAR(255) NULL',
                    'public' => 'TINYINT(1) UNSIGNED NOT NULL DEFAULT \'1\'',
                    'ord' => 'INT(11) NULL',
                ], $tableOptions_mysql);
            }
        }

        /* MYSQL */
        if (!in_array('team', $tables))  {
            if ($dbType == "mysql") {
                $this->createTable('{{%team}}', [
                    'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
                    0 => 'PRIMARY KEY (`id`)',
                    'name' => 'VARCHAR(255) NOT NULL',
                    'photo' => 'VARCHAR(255) NULL',
                    'phones' => 'VARCHAR(255) NULL',
                    'email' => 'VARCHAR(255) NULL',
                    'public' => 'TINYINT(1) NULL DEFAULT \'0\'',
                ], $tableOptions_mysql);
            }
        }


        $this->createIndex('idx_city_id_9953_00','city_objects','city_id',0);
        $this->createIndex('idx_product_id_0507_01','portion','product_id',0);
        $this->createIndex('idx_flavor_id_0507_02','portion','flavor_id',0);
        $this->createIndex('idx_category_id_0632_03','product','category_id',0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_city_9946_00','{{%city_objects}}', 'city_id', '{{%city}}', 'id', 'RESTRICT', 'RESTRICT' );
        $this->addForeignKey('fk_flavor_0498_01','{{%portion}}', 'flavor_id', '{{%flavor}}', 'id', 'RESTRICT', 'RESTRICT' );
        $this->addForeignKey('fk_product_0498_02','{{%portion}}', 'product_id', '{{%product}}', 'id', 'RESTRICT', 'RESTRICT' );
        $this->addForeignKey('fk_category_0626_03','{{%product}}', 'category_id', '{{%category}}', 'id', 'RESTRICT', 'RESTRICT' );
        $this->execute('SET foreign_key_checks = 1;');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `address`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `category`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `city`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `city_objects`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `content_block`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `file`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `flavor`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `news`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `portion`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `product`');
        $this->execute('SET foreign_key_checks = 1;');
        $this->execute('SET foreign_key_checks = 0');
        $this->execute('DROP TABLE IF EXISTS `team`');
        $this->execute('SET foreign_key_checks = 1;');
    }
}
