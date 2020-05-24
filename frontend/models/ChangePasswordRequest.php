<?php

namespace frontend\models;

use common\models\Hotels;
use common\models\Sms;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * ChangePasswordRequest
 */
class ChangePasswordRequest extends Model
{
    public $password;
    public $password_repeat;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password_repeat'], 'required'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Пароли не совпадают"],

        ];
    }

    public function attributeLabels()
    {
        return [
             'password' => 'Пароль',
            'password_repeat' => 'Пароль',
        ];
    }

    /**
     * changePassword
     *
     * @return User|null the saved model or null if saving fails
     */
    public function changePassword()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user = $user::findOne(\Yii::$app->user->identity->id);
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->save();
    }


}
