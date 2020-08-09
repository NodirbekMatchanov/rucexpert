<?php

namespace backend\models;

use backend\components\User;
use common\models\Video;
use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $date
 * @property string $creator
 * @property int $rubric_id
 * @property string $short_content
 * @property int $status
 * @property int $is_video
 * @property string $video
 */
class News extends \yii\db\ActiveRecord
{
    public $image;
    public $videoFile;
    const MODER = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'rubric_id'], 'required'],
            [['content', 'video', 'short_content'], 'string'],
            [['date'], 'safe'],
            [['rubric_id', 'is_video', 'status'], 'integer'],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions' => 'jpg, gif, png'],
            [['image'], 'file', 'maxSize' => '1000000'],
            [['videoFile'], 'safe'],
            [['videoFile'], 'file', 'extensions' => 'avi, mp4'],
            [['videoFile'], 'file', 'maxSize' => '200000000'],
            [['title', 'creator', 'img'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид',
            'title' => 'Заголовок',
            'content' => '',
            'date' => 'Дата',
            'creator' => 'Автор',
            'rubric_id' => 'Рубрика',
            'image' => 'Картинка новости',
            'short_content' => 'Кароткая описание',
            'video' => 'Код для вставки видео',
            'videoFile' => 'Загрузка видео файла',
        ];
    }

    public function beforeSave($insert)
    {
        if ($this->date == '') {
            $this->date = date("Y-m-d", time());
        } else {
            $this->date = date("Y-m-d", strtotime($this->date));
        }
        if (User::getRoleName() == 'admin') {
            $this->status = 2;
        } else {
            $this->status = self::MODER;
        }

        $this->videoFile = UploadedFile::getInstance($this, 'videoFile');
        if ($this->video != '' || !empty($this->videoFile)) {
            $this->is_video = 1;
        }
        $this->image = UploadedFile::getInstance($this, 'image');
        if (!empty($this->image)) {

            $fileName = rand(0, 999) . '_' . time() . '.' . $this->image->extension;
            if (!is_dir(Yii::getAlias('@frontend') . '/web/uploads/news/')) {
                mkdir(Yii::getAlias('@frontend') . '/web/uploads/news/');
            }
            $this->image->saveAs(Yii::getAlias('@frontend') . '/web/uploads/news/' . $fileName);
            $this->img = $fileName;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    public function afterSave($insert, $changedAttributes)
    {

        $this->videoFile = UploadedFile::getInstance($this, 'videoFile');
        if (!empty($this->videoFile)) {
            $video = new Video();
            $fileName = rand(0, 999) . '_' . time() . '.' . $this->videoFile->extension;
            if (!is_dir(Yii::getAlias('@frontend') . '/web/uploads/news/video/')) {
                mkdir(Yii::getAlias('@frontend') . '/web/uploads/news/video/');
            }
            $this->videoFile->saveAs(Yii::getAlias('@frontend') . '/web/uploads/news/video/' . $fileName);
            $video->url = $fileName;
            $video->parent_id = $this->id;
            $video->save();
        }
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
    }

    public static function getNewsGroupByRubric()
    {
//      статус 2 разрешенный наовости
        $homeNews = self::find()->where(['status' => 2])->andWhere('date <= "'. date("Y-m-d").'"')->orderBy('id desc')->asArray()->all();
        return self::getHomePageNews($homeNews);
    }

    public static function getHomePageNews($news)
    {
        $homeNewsList = [];
        if (!empty($news)) {
            foreach ($news as $item) {
                if (!empty($homeNewsList) && isset($homeNewsList[$item['rubric_id']])) {
                    $count = count($homeNewsList[$item['rubric_id']]);
                    if ($count < 2) {
                        $homeNewsList[$item['rubric_id']][] = $item;
                    }
                } else {
                    $homeNewsList[$item['rubric_id']][] = $item;
                }
            }
        }

        return $homeNewsList;
    }
}
