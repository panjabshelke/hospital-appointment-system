<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_category_master}}`.
 */
class m200422_081912_tbl_pages_detail extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_pages_detail}}', [
            'id' => $this->primaryKey(),
            'title'=> $this->string(500)->notNull(),
            'slug'=> $this->text()->notNull(),
            'description' => $this->text()->notNull(),
            'page_image' => $this->text()->null(),
            'created_by'=> $this->integer(11)->notNull(),
            'created_at'=> $this->dateTime(). ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'updated_by'=> $this->integer(11)->notNull(),
            'updated_at'=> $this->dateTime(). ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'status' => "ENUM('active','inactive', 'deleted') DEFAULT 'active'",
        ]);
        // $this->addForeignKey('fk-parent_id', 'tbl_category_master', 'parent_id', 'tbl_category_master', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_pages_detail}}');
    }
}
