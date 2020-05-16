<?php

namespace backend\components;

use Yii;

/**
 * Extended yii\web\User
 *
 * This allows us to do "Yii::$app->user->something" by adding getters
 * like "public function getSomething()"
 *
 * So we can use variables and functions directly in `Yii::$app->user`
 */
class User extends \yii\web\User
{
    public function getUsername()
    {
        return \Yii::$app->user->identity->username;
    }

    public function getUpdatedAt()
    {
        return \Yii::$app->user->identity->updated_at;
    }

    public static function getRole($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->getUser()->identity->getId();
        }
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment where user_id=" . $id)
            ->queryOne();

        return $roleModel['item_name'];
    }

    public static function getRoleName($id = null)
    {
        if ($id == null) {
            $id = Yii::$app->getUser()->identity->getId();
        }
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment  INNER JOIN auth_item ON auth_item.name = auth_assignment.item_name where user_id = " . $id)
            ->queryOne();

        return $roleModel['description'];
    }
    public static function getRoleNames()
    {
        $roleModel = Yii::$app->db
            ->createCommand("Select * from auth_assignment  INNER JOIN auth_item ON auth_item.name = auth_assignment.item_name ")
            ->queryAll();

        return $roleModel;
    }



    public static function getAdminsIds()
    {
        $courier = \Yii::$app->authManager->getUserIdsByRole('admin');
        return $courier;
    }

    public static function getGuidesIds()
    {
        $courier = \Yii::$app->authManager->getUserIdsByRole('guide');
        return $courier;
    }

}
