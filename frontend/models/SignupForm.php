<?php

namespace frontend\models;

use common\models\Hotels;
use common\models\Sms;
use yii\base\Model;
use common\models\User;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $company;
    public $code;
    public $license_file;
    public $license_id;
    public $license_date;
    public $policy;
    public $phone;
    public $avatar;
    public $password_repeat;
    public $file;
    public $fileName;
    public $reg_hotel_type;
    public $reg_car_type;
    public $reg_rent_type;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            [['company', 'policy', 'code', 'phone', 'password_repeat'], 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [['company', 'license_file'], 'string', 'max' => 255],
            [['license_id', 'reg_rent_type', 'reg_car_type', 'reg_hotel_type', 'phone', 'policy'], 'string', 'max' => 50],
            ['license_date', 'safe'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            [['file'], 'file', 'maxSize' => '100000'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false, 'message' => "Пароли не совпадают"],
            ['code', 'validateCode'],
            [['policy'], 'required', 'requiredValue' => 1, 'message' => 'Подтвердите согласие с политикой конфидициальности'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'username' => 'НАЗВАНИЕ ОРГАНИЗАЦИИ',
            'email' => 'email',
            'role' => 'Роль',
            'password' => 'Пароль',
            'password_repeat' => 'Пароль',
            'phone' => 'ТЕЛЕФОН',
            'code' => 'СМС ДЛЯ ПОДТВЕРЖДЕНИЯ',
            'company' => 'НАЗВАНИЕ ОРГАНИЗАЦИИ',
            'file' => 'ЗАГРУЗИТЕ ЛИЦЕНЗИЮ (ПРИ НАЛИЧИИ)',
            'license_file' => 'ЗАГРУЗИТЕ ЛИЦЕНЗИЮ (ПРИ НАЛИЧИИ)',
            'license_date' => 'ДАТА ВЫДАЧИ (ПРИ НАЛИЧИИ)',
            'license_id' => '№ ЛИЦЕНЗИИ (ПРИ НАЛИЧИИ)',
            'reg_hotel_type' => 'ОТЕЛИ / ХОСТЕЛЫ',
            'reg_car_type' => 'ПРОКАТ АВТОМАШИН/КАРШЕРИНГ',
            'reg_rent_type' => 'АРЕНДА ПОМЕЩЕНИЙ',
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
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $this->beforeSave();
        if ($user->save()) {
            $hotels->company = $this->company;
            $hotels->reg_hotel_type = $this->reg_hotel_type;
            $hotels->reg_car_type = $this->reg_car_type;
            $hotels->reg_rent_type = $this->reg_rent_type;
            $hotels->license_id = $this->license_id;
            $hotels->license_date = $this->license_date;
            $hotels->license_file = $this->fileName;
            $hotels->politics = $this->policy;
            $hotels->phone = $this->phone;
            $hotels->avatar = $this->avatar;
            $hotels->balance = 0;
            $hotels->count_bonus_find = 5;
            $hotels->save();
            try {
                $this->sendEmail($user, $hotels);
            } catch (\Exception $e){
                print_r($e);
                die();
            }
            $sms = new Sms();
            $code = $sms::find()->where(['code' => $this->code, 'phone' => $this->phone])->one();
            $code->delete();
        }
        $user->hotel_id = $hotels->id;
        $last_id = $user->id;
        $userRole = \Yii::$app->authManager->getRole('director');
        \Yii::$app->authManager->assign($userRole, $last_id);
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

    public function beforeSave()
    {
        // загрузка файлов
        $this->file = UploadedFile::getInstance($this, 'file');
        if (!empty($this->file)) {

            $fileName = rand(0, 999) . '_' . time() . '.' . $this->file->extension;
            if (!is_dir(\Yii::getAlias('@frontend') . '/web/uploads/files/')) {
                mkdir(\Yii::getAlias('@frontend') . '/web/uploads/files/');
            }
            $this->file->saveAs(\Yii::getAlias('@frontend') . '/web/uploads/files/' . $fileName);
            $this->fileName = $fileName;
        }
        // загрузка аватара для директора
        $this->avatar = UploadedFile::getInstance($this, 'avatar');
        if (!empty($this->avatar)) {

            $fileName = rand(0, 999) . '_' . time() . '.' . $this->file->extension;
            if (!is_dir(\Yii::getAlias('@frontend') . '/web/uploads/files/')) {
                mkdir(\Yii::getAlias('@frontend') . '/web/uploads/files/');
            }
            $this->avatar->saveAs(\Yii::getAlias('@frontend') . '/web/uploads/files/' . $fileName);
            $this->avatar = $fileName;
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
            ->setHtmlBody('<p>Зарегистрирован пользовтель ' . Html::encode($user->username) .
                '</p><p>Компания: ' . $hotel->company . '</p>'.
                '</p><p>Номер телефона: ' . $hotel->phone . '</p>'
            )
            ->send();
    }
}
