<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "black_list".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $middle_name
 * @property string $comment
 * @property string $date_born
 * @property string $place_born
 * @property int $moder
 * @property string $moder_comment
 * @property string $ser_num_car
 * @property int $type_org
 * @property int $user_id
 * @property string $phone
 * @property string $email
 * @property int $status
 * @property string $passport_num
 * @property string $passport_ser
 * @property string $numb_car
 */
class BlackList extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'black_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'moder_comment'], 'string'],
            [['date_born'], 'safe'],
            [['moder', 'type_org', 'user_id', 'status'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'place_born', 'ser_num_car', 'phone', 'email'], 'string', 'max' => 255],
            [['numb_car','passport_ser','passport_num'], 'string', 'max' => 50],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'ИМЯ',
            'last_name' => 'ФАМИЛИЯ',
            'middle_name' => 'ОТЧЕСТВО',
            'comment' => 'КРАТКОЕ ОПИСАНИЕ ПРАВОНАРУШЕНИЯ *',
            'date_born' => 'ДАТА РОЖДЕНИЯ',
            'place_born' => 'МЕСТО РОЖДЕНИЯ',
            'moder' => 'Moder',
            'moder_comment' => 'Moder Comment',
            'ser_num_car' => 'Серия водительского удостоверения',
            'type_org' => 'БАЗА ДАННЫХ',
            'user_id' => 'User ID',
            'phone' => 'ТЕЛЕФОН',
            'email' => 'EMAIL',
            'passport_ser' => 'Серия паспорта',
            'passport_num' => 'Номер паспорта',
            'numb_car' => 'Номер водительского удостоверения',
            'status' => 'Status',
        ];
    }
}
