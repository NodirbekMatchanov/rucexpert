<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property int $user_id
 * @property double $summ
 * @property string $description
 * @property int $status
 */
class Invoice extends \yii\db\ActiveRecord
{
    CONST STATUS_PENDING = 1;
    CONST STATUS_SUCCESS = 2;
    CONST STATUS_ACCEPTED = 4;
    CONST STATUS_FAIL = 3;

    public function __construct($config = [])
    {
        $this->status = self::STATUS_PENDING;
        $this->user_id = Yii::$app->user->identity->id;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['summ'], 'number'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'summ' => 'Сумма',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }
}
