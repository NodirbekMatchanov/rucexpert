<?php


namespace backend\models;

use Yii; 
use yii\base\Model;

class ImportForm extends Model
{
    public $file;
    public $fileYml;

    public function rules()
    {
        return [
            ['file', 'file', 'skipOnEmpty' => true, 'extensions' => 'csv,xls,xlsx'],
            ['fileYml', 'file', 'skipOnEmpty' => true, 'extensions' => 'yml'],
        ];
    }
}