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
use common\models\News;
use Yii;
use backend\models\ImportForm;
use yii\web\UploadedFile;

class Importer
{

    /** Импорт нарушителей из csv файла
     * @param $uploadFile
     * @param $count
     * @param $time
     * @return int
     */
    public static function importCsv($uploadFile, $count, $time)
    {
        if (($handle = fopen($uploadFile->tempName, 'r')) !== false) {
            $i = 1;
            $savedData = 0;
            $countSaved = 0;
            $datePublic = date("Y-m-d") . ' ' . $time;
            while (($row = fgetcsv($handle, 100000, ';')) !== false) {
                if ($countSaved == $count) {
                    $countSaved = 0;
                    $datePublic = self::getDate(date("Y-m-d", strtotime($datePublic)), $time);
                }
                if ($i > 1) {
                    $model = new BlackList();
                    if (isset($row[1]) && !empty($row[1])) {
                        $fullName = explode(' ', $row[1]);
                    }
                    $model->first_name = $fullName[1] ?? '';
                    $model->last_name = $fullName[0] ?? '';
                    $model->middle_name = $fullName[2] ?? '';
                    $model->phone = $row[2] ?? '';
                    $model->date_born = $row[3] ?? '';
                    $model->comment = $row[4] ?? '';
                    $model->status = 2;
                    $model->date_public = $datePublic;
                    $model->place_born = $row[6] ?? '';
                    $model->email = $row[7] ?? '';
                    $model->ser_num_car = $row[11] ?? '';
                    $model->type_org = $row[12] ?? '';
                    $model->user_id = Yii::$app->getUser()->identity->id;

                    if ($model->validate()) {
                        $model->save();
                        $gallery = new Gallery();
                        if (!empty($row[5])) {
                            $gallery->url = $row[5];
                            $gallery->parent_id = $model->id;
                            $gallery->save();
                        }
                        $savedData++;
                        $countSaved++;
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

    /** Импорт новости из csv файла
     * @param $uploadFile
     * @param $count
     * @param $time
     * @return int
     */
    public static function importCsvNews($uploadFile)
    {
        if (($handle = fopen($uploadFile->tempName, 'r')) !== false) {
            $i = 1;
            $savedData = 0;
            while (($row = fgetcsv($handle, 100000, ';')) !== false) {
                if ($i > 1) {
                    $model = new News();
                    $model->title = $row[3] ?? '';
                    $model->content = $row[4] ?? '';
                    $model->short_content = $row[4] ?? '';
                    $model->img = $row[5] ?? '';
                    switch ($row[2]) {
                        case 0:
                            $row[2] = 1;
                            break;
                        case 1:
                            $row[2] = 3;
                            break;
                    }
                    $model->rubric_id = $row[2] ?? '';
                    $model->date = date("Y-m-d", strtotime($row[1])) ?? '';
                    $model->status = 2;
                    $model->creator = 'Admin';
                    $model->save();
                    if ($model->validate()) {
                        $model->save();
                        $savedData++;
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

    public static function getDate($date, $time)
    {
        return date("Y-m-d", strtotime($date . "+1 days")) . ' ' . $time;
    }

}