<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%video}}`.
 */
class m200617_070016_create_video_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%video}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(),
            'parent_id' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%video}}');
    }
}
