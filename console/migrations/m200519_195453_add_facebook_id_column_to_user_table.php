<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m200519_195453_add_facebook_id_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'facebook_id', $this->string(255));
        $this->addColumn('{{%user}}', 'google_id', $this->string(255));
        $this->addColumn('{{%user}}', 'vkontakte_id', $this->string(255));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'facebook_id');
        $this->dropColumn('{{%user}}', 'google_id');
        $this->dropColumn('{{%user}}', 'vkontakte_id');
    }
}
