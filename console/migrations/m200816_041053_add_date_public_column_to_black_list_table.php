<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%black_list}}`.
 */
class m200816_041053_add_date_public_column_to_black_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%black_list}}', 'date_public', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%black_list}}', 'date_public');
    }
}
