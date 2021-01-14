<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_category_master}}`.
 */
class m200215_081912_create_category_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_category_master}}', [
            'id' => $this->primaryKey(),
            'category_name'=>$this->string()->notNull(),
            'slug'=>$this->string()->notNull(),
            'parent_id' => $this->integer(),
            'created_by'=> $this->integer().' DEFAULT 0',
            'created_at' => $this->dateTime(). ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'modified_at' => $this->dateTime()->notNull() . ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'status' => "ENUM('active','inactive', 'deleted') DEFAULT 'active'",
        ]);
        // $this->addForeignKey('fk-parent_id', 'tbl_category_master', 'parent_id', 'tbl_category_master', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_category_master}}');
    }
}
