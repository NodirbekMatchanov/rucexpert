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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'middle_name' => 'Middle Name',
            'comment' => 'Comment',
            'date_born' => 'Date Born',
            'place_born' => 'Place Born',
            'moder' => 'Moder',
            'moder_comment' => 'Moder Comment',
            'ser_num_car' => 'Ser Num Car',
            'type_org' => 'Type Org',
            'user_id' => 'User ID',
            'phone' => 'Phone',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }
}
