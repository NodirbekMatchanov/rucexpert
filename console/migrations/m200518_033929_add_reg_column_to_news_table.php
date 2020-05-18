<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%news}}`.
 */
class m200518_033929_add_reg_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'company', $this->string(255));
        $this->addColumn('{{%news}}', 'phone', $this->string(50));
        $this->addColumn('{{%news}}', 'license_file', $this->string(255));
        $this->addColumn('{{%news}}', 'license_id', $this->string(50));
        $this->addColumn('{{%news}}', 'license_date', $this->dateTime());
        $this->addColumn('{{%news}}', 'politics', $this->string(10));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%news}}', 'company');
        $this->dropColumn('{{%news}}', 'phone');
        $this->dropColumn('{{%news}}', 'license_file');
        $this->dropColumn('{{%news}}', 'license_id');
        $this->dropColumn('{{%news}}', 'license_date');
        $this->dropColumn('{{%news}}', 'politics');
    }
}
