<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property int $id
 * @property string $url
 * @property int $parent_id
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'parent_id' => 'Parent ID',
        ];
    }
}
