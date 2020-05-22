<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rubric".
 *
 * @property int $id
 * @property string $title
 * @property float $price
 */
class Rubric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rubric';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 50],
            [['price'], 'number'],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'title' => 'Название',
            'price' => 'Цена',
        ];
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getAll()
    {
        $rubrics = Rubric::find()->all();
        $rubrics = ArrayHelper::map($rubrics, 'id', 'title');
        return $rubrics;
    }

}
