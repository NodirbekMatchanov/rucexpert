<?php
/**
 * Created by PhpStorm.
 * User: Нодирбек
 * Date: 17.09.2020
 * Time: 16:35
 */

namespace frontend\models;

use yii\base\Model;
use common\models\User;
use yii\helpers\Html;
use yii\web\UploadedFile;

class NewsFeedBack extends Model
{
    public $fullName;
    public $email;
    public $phone;
    public $text;
    public $file;
    public $attachFile;
    public $reCaptcha;
    public function rules()
    {
        return [
            ['fullName', 'trim'],
            [['fullName'], 'required'],
            ['fullName', 'string', 'min' => 2, 'max' => 255],
            [['text'], 'string'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 255],
            [['attachFile'], 'file', 'maxSize' => '100000'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator3::className(),
        'secret' => '6LfFrc0ZAAAAAJGFcLGRKWGI2nv5b68j0nK4N1xD', // unnecessary if reСaptcha is already configured
        'threshold' => 0.5,
        'action' => 'feed-back',
      ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'fullName' => 'Имя',
            'email' => 'email',
            'phone' => 'Телефон',
            'attachFile' => 'Прикрепить файл',
            'text' => 'Текст новости',
        ];
    }


    public function sendFeedBack()
    {
        $this->attachFile = UploadedFile::getInstance($this, 'attachFile');
        if (!empty($this->attachFile)) {

            $fileName = rand(0, 999) . '_' . time() . '.' . $this->attachFile->extension;
            if (!is_dir(\Yii::getAlias('@frontend') . '/web/uploads/files/')) {
                mkdir(\Yii::getAlias('@frontend') . '/web/uploads/files/');
            }
            $this->attachFile->saveAs(\Yii::getAlias('@frontend') . '/web/uploads/files/' . $fileName);
            $this->attachFile = $fileName;
        }
        $sender = \Yii::$app
            ->mailer
            ->compose();
        if(!empty($this->attachFile)){
            $sender->attach(\Yii::getAlias('@frontend') . '/web/uploads/files/' . $this->attachFile );
        }
        $sender
            ->setFrom(['demin@ruc.expert' => 'Robot'])
            ->setTo(\Yii::$app->params['emailInfo'])
            ->setSubject('Добавления новости')
            ->setHtmlBody('<p>Добавления новости' .
                '</p><p>Имя : ' . $this->fullName . '</p>' .
                '</p><p>email: ' . $this->email . '</p>' .
                '</p><p>Номер телефона: ' . $this->phone . '</p>' .
                '</p><p>Текст: ' . $this->text . '</p>'
            )
            ->send();

        return $sender;
    }

}