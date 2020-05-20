<?php

namespace frontend\models;

use common\models\Hotels;
use common\models\Sms;
use yii\base\Model;
use common\models\User;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class EmplayeeForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $last_name;
    public $first_name;
    public $password_repeat;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [[ 'first_name', 'password_repeat'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['license_date', 'safe'],
            [['email','last_name'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Пароли не совпадают"],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'email',
            'role' => 'Роль',
            'password' => 'Пароль',
            'password_repeat' => 'Пароль',
            'phone' => 'ТЕЛЕФОН',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->email;
        $user->email = $this->email;
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->parent_id = \Yii::$app->user->identity->getId();
        if($user->save()){
            $last_id = $user->id;
            $userRole = \Yii::$app->authManager->getRole('manager');
            \Yii::$app->authManager->assign($userRole, $last_id);
            return $user->save() ? $user : null;
        } else {
            $user->addError('username','ошибка при создании пользователя');
            return null;
        }

    }

}
