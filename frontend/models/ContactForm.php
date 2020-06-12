<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $phone;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'name' => 'Имя',
            'phone' => 'Телефон',
            'subject' => 'Тип обращения:',
            'body' => 'Сообщение',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        try {
            return Yii::$app->mailer->compose()
                ->setFrom(['group.scala@mail.ru' => 'Robot'])
                ->setTo(Yii::$app->params['supportEmail'])
                ->setSubject($this->subject)
                ->setHtmlBody(
                    "<p>Имя:   {$this->name}</p>" .
                    "<p>Телефон:  {$this->phone} </p>" .
                    "<p>e-mail:  {$this->email} </p>" .
                    '<p>' . $this->body . '</p>')
                ->send();
        } catch (\Exception $exception) {
            return false;
        }
    }

    public static function getSubjects()
    {
        return [
            'Тех.поддержка' => 'Тех.поддержка',
            'Финансовая служба' => ' Финансовая служба',
            'Удаление пользователя из реестра' => 'Удаление пользователя из реестра'
        ];
    }
}
