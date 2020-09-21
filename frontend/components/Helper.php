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
    public static function getRubricWords()
    {
        $wordList = [
            'hotel' => 'отелей',
            'karshering' => 'каршеринга',
            'rent' => 'аренды',
            'car-rent' => 'аренды авто',
        ];
        return $wordList;
    }

    public static function formatPhone($phone)
    {
        $phone = trim($phone);

        $res = preg_replace(
            array(
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
            ),
            array(
                '+7 $2 $3 $4 $5',
                '+7 $2 $3 $4 $5',
                '+7 $2 $3 $4 $5',
                '+7 $2 $3 $4 $5',
                '+7 $2 $3 $4',
                '+7 $2 $3 $4',
            ),
            $phone
        );
        $formatPhone = "+".str_replace("+","",$res);
        return str_replace(" ",'', $formatPhone);
    }
}