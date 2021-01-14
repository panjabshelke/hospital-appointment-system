<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_category_master}}`.
 */
class m200422_081912_tbl_banner extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_banner}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(500)->null(),
            'image'=> $this->text(),
            'status' => "ENUM('active','inactive', 'deleted') DEFAULT 'active'",
        ]);
        // $this->addForeignKey('fk-parent_id', 'tbl_category_master', 'parent_id', 'tbl_category_master', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_banner}}');
    }
}
