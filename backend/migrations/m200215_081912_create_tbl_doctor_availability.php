<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tbl_doctor_availability}}`.
 */
class m200215_081912_create_tbl_doctor_availability extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tbl_doctor_availability}}', [
            'id' => $this->primaryKey(),
            'doctor_id' => $this->integer()->notNull(),
            'branch_id' => $this->integer()->notNull(),
            'available_from' => $this->dateTime()->notNull(),
            'available_upto' => $this->dateTime()->notNull(),
            'status' => "ENUM('Pending','Approved', 'Cancelled') DEFAULT 'Approved'",
            'created_at' => $this->dateTime(). ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
            'modified_at' => $this->dateTime()->notNull() . ' DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);
        // $this->addForeignKey('fk-parent_id', 'tbl_doctor_availability', 'parent_id', 'tbl_category_master', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tbl_doctor_availability}}');
    }
}
