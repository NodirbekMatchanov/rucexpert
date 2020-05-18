<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hotels}}`.
 */
class m200518_041603_create_hotels_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%hotels}}', [
            'id' => $this->primaryKey(),
            'company' => $this->string(255),
            'phone' => $this->string(50),
            'license_file' => $this->string(255),
            'license_id' => $this->string(50),
            'license_date' => $this->dateTime(),
            'politics' => $this->string(10),
            'date_create' => $this->dateTime(),
            'balance' => $this->float(),
            'count_bonus_find' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%hotels}}');
    }
}
