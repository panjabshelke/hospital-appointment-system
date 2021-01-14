<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_category_master}}`.
 */
class m200423_081912_tbl_testimonials extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_testimonials}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(500)->null(),
            'description' => $this->text()->notNull(),
            'image'=> $this->text(),
           
        ]);
        // $this->addForeignKey('fk-parent_id', 'tbl_category_master', 'parent_id', 'tbl_category_master', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_testimonials}}');
    }
}
