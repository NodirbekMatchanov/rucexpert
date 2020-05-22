<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%black_list}}`.
 */
class m200521_192638_create_black_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%black_list}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'middle_name' => $this->string(),
            'comment' => $this->text(),
            'date_born' => $this->date(),
            'place_born' => $this->string(),
            'moder' => $this->integer(),
            'moder_comment' => $this->text(),
            'ser_num_car' => $this->string(),
            'type_org' => $this->integer(),
            'user_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%black_list}}');
    }
}
