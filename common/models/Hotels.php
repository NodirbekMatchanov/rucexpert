<?php

namespace common\models;

use Yii;

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
 */
class Hotels extends \yii\db\ActiveRecord
{
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
            [['company', 'license_file'], 'string', 'max' => 255],
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
            'company' => 'Company',
            'phone' => 'Phone',
            'license_file' => 'License File',
            'license_id' => 'License ID',
            'license_date' => 'License Date',
            'politics' => 'Politics',
            'date_create' => 'Date Create',
            'balance' => 'Balance',
            'count_bonus_find' => 'Count Bonus Find',
        ];
    }
}
