<?php

use yii\db\Migration;

/**
 * Class m200608_131939_add_status_column_news_table
 */
class m200608_131939_add_status_column_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%news}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200608_131939_add_status_column_news_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200608_131939_add_status_column_news_table cannot be reverted.\n";

        return false;
    }
    */
}
