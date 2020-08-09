<?php
/**
 * Created by PhpStorm.
 * User: Нодирбек
 * Date: 08.08.2020
 * Time: 10:14
 */

namespace backend\components;

use backend\models\BlackList;
use backend\models\Gallery;
use Yii;
use backend\models\ImportForm;
use yii\web\UploadedFile;

class Importer
{

    /**
     * Импорт товаров из csv файла
     */
    public static function importCsv($uploadFile)
    {
            if (($handle = fopen($uploadFile->tempName, 'r')) !== false) {
                $i = 1;
                $savedData = 0;
                while (($row = fgetcsv($handle, 100000, ';')) !== false) {
                    if ($i > 1) {
                        $model = new BlackList();
                        if(isset($row[1]) && !empty($row[1])){
                            $fullName = explode(' ',$row[1]);
                        }
                        $model->first_name = $fullName[1] ?? '';
                        $model->last_name = $fullName[0] ?? '' ;
                        $model->middle_name = $fullName[2] ?? '';
                        $model->phone = $row[2] ?? '';
                        $model->date_born = $row[3] ?? '';
                        $model->comment = $row[4] ?? '';
                        $model->moder = 1;
                        $model->place_born = $row[6] ?? '';
                        $model->email = $row[7] ?? '';
                        $model->ser_num_car = $row[11] ?? '';
                        $model->type_org = $row[12] ?? '';
                        $model->user_id = Yii::$app->getUser()->identity->id;

                        if ($model->validate()) {
                            $model->save();
                            $gallery = new Gallery();
                            if(!empty($row[5])){
                                $gallery->url = $row[5];
                                $gallery->parent_id = $model->id;
                                $gallery->save();
                            }
                            $savedData ++;
                        } else {
                            $notValid [] = $row[0];
                            //... код в случае ошибки сохранения
                        }
                    }
                    $i++;
                }
                fclose($handle);
            }
            return $savedData;
    }

}