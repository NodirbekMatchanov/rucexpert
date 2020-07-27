<?php
/**
 * Created by PhpStorm.
 * User: Нодирбек
 * Date: 27.07.2020
 * Time: 22:38
 */

namespace frontend\components;


class Helper
{
    public static function getRubricWords(){
        $wordList = [
          'hotel' => 'отелей',
          'karshering' => 'каршеринга',
          'rent' => 'аренды',
          'car-rent' => 'аренды авто',
        ];
        return $wordList;
    }
}