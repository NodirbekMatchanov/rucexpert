<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rubric}}`.
 */
class m200521_192208_add_price_column_to_rubric_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%rubric}}', 'price', $this->float());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%rubric}}', 'price');
    }
}
