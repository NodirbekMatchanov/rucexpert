<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%news}}`.
 */
class m200518_111434_add_reg_types_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%hotels}}', 'reg_hotel_type', $this->integer());
        $this->addColumn('{{%hotels}}', 'reg_car_type', $this->integer());
        $this->addColumn('{{%hotels}}', 'reg_rent_type', $this->integer());
        $this->addColumn('{{%hotels}}', 'avatar', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%hotels}}', 'reg_hotel_type');
        $this->dropColumn('{{%hotels}}', 'reg_car_type');
        $this->dropColumn('{{%hotels}}', 'reg_rent_type');
        $this->dropColumn('{{%hotels}}', 'avatar');
    }
}
