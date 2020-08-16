<?php


namespace backend\models;

use Yii;
use yii\base\Model;

class ImportForm extends Model
{
    public $file;
    public $fileYml;
    public $count;
    public $time;

    public function rules()
    {
        return [
            ['time','safe'],
            ['count','integer'],
            ['file', 'file', 'skipOnEmpty' => true, 'extensions' => 'csv'],
        ];
    }
}