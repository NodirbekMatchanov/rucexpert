<?php

use yii\db\Migration;

/**
 * Class m200514_083151_init_rbac_2
 */
class m200514_083151_init_rbac_2 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // add "author" role and give this role the "createPost" permission
        $author = $auth->createRole('manager');
        $auth->add($author);

        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('director');
        $auth->add($admin);
        $auth->addChild($admin, $author);

    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200514_083151_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
