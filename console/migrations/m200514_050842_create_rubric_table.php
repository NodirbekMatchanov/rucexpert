<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rubric`.
 */
class m200514_050842_create_rubric_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'date' => $this->dateTime(),
            'creator' => $this->string(),
            'rubric_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('rubric');
    }
}
