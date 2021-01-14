<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_teams}}`.
 */
class m200423_081912_tbl_teams extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_teams}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(500)->null(),
            'description' => $this->text()->notNull(),
            'image'=> $this->text(),
           
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_teams}}');
    }
}
