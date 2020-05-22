<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%black_list}}`.
 */
class m200521_193605_add_phone_column_to_black_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%black_list}}', 'phone', $this->string());
        $this->addColumn('{{%black_list}}', 'email', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%black_list}}', 'phone');
        $this->dropColumn('{{%black_list}}', 'email');
    }
}
