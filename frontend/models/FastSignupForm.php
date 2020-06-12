<?php

namespace frontend\models;

use backend\components\Sender;
use common\models\Hotels;
use common\models\Sms;
use yii\base\Model;
use common\models\User;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * Fast Signup form
 */
class FastSignupForm extends Model
{
    public $username;
    public $phone;
    public $email;
    public $code;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['code', 'phone'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [['email', 'code'], 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'string', 'min' => 6],
            ['code', 'validateCode']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'username' => 'НАЗВАНИЕ ОРГАНИЗАЦИИ',
            'email' => 'email',
            'role' => 'Роль',
            'code' => 'Код',
            'password' => 'Пароль',
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
        $hotels = new Hotels();
        $user->username = $this->email;
        $user->email = $this->email;
        $this->password = \Yii::$app->security->generateRandomString(7);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        if ($user->save()) {
            $hotels->phone = $this->phone;
            $hotels->balance = 0;
            $hotels->count_bonus_find = 5;
            $hotels->save();
            try {
                $this->sendEmail($user, $hotels);
            } catch (\Exception $e) {
                \Yii::info('ошибка при отправке');
            }
            $sms = new Sms();
            $code = $sms::find()->where(['code' => $this->code, 'phone' => $this->phone])->one();
            $code->delete();
        }
        $user->hotel_id = $hotels->id;
        $last_id = $user->id;
        $userRole = \Yii::$app->authManager->getRole('director');
        \Yii::$app->authManager->assign($userRole, $last_id);
        try {
            $this->sendCode();
            $this->sendToUserEmail();
        } catch (\Exception $exception) {
            \Yii::info('Ошибка при отпраке данных');
        }
        return $user->save() ? $user : null;
    }

    /** валидация смс кода для подтвердении
     * @param $attribute
     * @param $params
     */
    public function validateCode($attribute, $params)
    {
        $sms = new Sms();
        $code = $sms::find()->where(['code' => $this->code, 'phone' => $this->phone])->one();
        if (empty($code)) {
            $this->addError($attribute, 'код не корректный');
        }
    }


    protected function sendEmail($user, $hotel)
    {
        return \Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['group.scala@mail.ru' => 'Robot'])
            ->setTo(\Yii::$app->params['notification'])
            ->setSubject('Зарегистрирован новый пользователь RucExport')
            ->setHtmlBody('<p>Зарегистрирован пользовтель ' . Html::encode($user->username) . ' passw: ' . $this->password .
                '</p><p>Компания: ' . $hotel->company . '</p>' .
                '</p><p>Номер телефона: ' . $hotel->phone . '</p>'
            )
            ->send();
    }

    protected function sendToUserEmail()
    {
        return \Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['group.scala@mail.ru' => 'Robot'])
            ->setTo($this->email)
            ->setSubject('Вы зарегистрировались на сайте ruc.expert')
            ->setHtmlBody('<p>Вы зарегистрировались на сайте ruc.expert Логин: ' . Html::encode($this->email) . ' Пароль: ' . $this->password)
            ->send();
    }

    public function sendCode()
    {

        if (\Yii::$app->request->isAjax) {
            $text = 'Вы зарегистрировались на сайте ruc.expert'
                . PHP_EOL . ' Логин:' . $this->email .
                PHP_EOL . ' Пароль:' . $this->password;
            $messages = new Sender(\Yii::$app->params['sms_login'], \Yii::$app->params['sms_passwd']);
            $messages = $messages->messageObj;
            $messages->setUrl(\Yii::$app->params['sms_host']);
            $mes = $messages->createNewMessage(\Yii::$app->params['sms_sender'], $text, 'sms');
//
            $abonent = $mes->createAbonent('+' . $this->phone);
            $abonent->setNumberSms(1);
            $mes->addAbonent($abonent);
            //$abonent->setTimeSend("2015-12-15 15:12");
            //$abonent->setValidityPeriod("2015-12-16 16:00");
            $mes->addAbonent($abonent);

            $messages->addMessage($mes);
            if (!$messages->send()) {
                \Yii::info($messages->getError());
                return false;
            } else {
                \Yii::info(($messages->getResponse()));
                return true;
            }
        } else {
            return false;
        }
    }
}
