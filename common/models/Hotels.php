<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "hotels".
 *
 * @property int $id
 * @property string $company
 * @property string $phone
 * @property string $license_file
 * @property string $license_id
 * @property string $license_date
 * @property string $politics
 * @property string $date_create
 * @property double $balance
 * @property int $count_bonus_find
 * @property int $reg_hotel_type
 * @property int $reg_car_type
 * @property int $reg_rent_type
 * @property string $avatar
 */
class Hotels extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['license_date', 'date_create'], 'safe'],
            [['balance'], 'number'],
            [['reg_hotel_type','reg_car_type','reg_rent_type','count_bonus_find'], 'integer'],
            [['company','avatar','license_file'], 'string', 'max' => 255],
            [['file'], 'file', 'maxSize' => '100000', 'extensions' => 'jpg, png, jpeg'],
            [['phone', 'license_id'], 'string', 'max' => 50],
            [['politics'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company' => 'НАЗВАНИЕ ОРГАНИЗАЦИИ',
            'phone' => 'ТЕЛЕФОН',
            'license_file' => 'ЗАГРУЗИТЕ ЛИЦЕНЗИЮ (ПРИ НАЛИЧИИ)',
            'license_id' => '№ ЛИЦЕНЗИИ (ПРИ НАЛИЧИИ)',
            'license_date' => 'ДАТА ВЫДАЧИ (ПРИ НАЛИЧИИ)',
            'politics' => 'Politics',
            'date_create' => 'Date Create',
            'balance' => 'Баланс',
            'count_bonus_find' => 'Бонус',
            'reg_hotel_type' => 'ОТЕЛИ / ХОСТЕЛЫ',
            'reg_car_type' => 'ПРОКАТ АВТОМАШИН/КАРШЕРИНГ',
            'reg_rent_type' => 'АРЕНДА ПОМЕЩЕНИЙ',
        ];
    }

    public function beforeSave($insert)
    {
        // загрузка аватара для директора
        $this->file = UploadedFile::getInstance($this, 'file');
        if (!empty($this->file)) {

            $fileName = rand(0, 999) . '_' . time() . '.' . $this->file->extension;
            if (!is_dir(\Yii::getAlias('@frontend') . '/web/uploads/files/')) {
                mkdir(\Yii::getAlias('@frontend') . '/web/uploads/files/');
            }
            $this->file->saveAs(\Yii::getAlias('@frontend') . '/web/uploads/files/' . $fileName);
            $this->avatar = $fileName;
        }
        return true;
    }
}
