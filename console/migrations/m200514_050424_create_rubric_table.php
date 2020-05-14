<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rubric`.
 */
class m200514_050424_create_rubric_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rubric', [
            'id' => $this->primaryKey(),
            'title' => $this->string(50)->notNull()->unique(),
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
