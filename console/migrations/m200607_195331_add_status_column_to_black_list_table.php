<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%black_list}}`.
 */
class m200607_195331_add_status_column_to_black_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%black_list}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%black_list}}', 'status');
    }
}
