<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%black_list}}`.
 */
class m200612_102128_add_passport_column_to_black_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%black_list}}', 'passport_num', $this->string(20));
        $this->addColumn('{{%black_list}}', 'passport_ser', $this->string(20));
        $this->addColumn('{{%black_list}}', 'numb_car', $this->string(50));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%black_list}}', 'passport_num');
        $this->dropColumn('{{%black_list}}', 'passport_ser');
        $this->dropColumn('{{%black_list}}', 'numb_car');
    }
}
