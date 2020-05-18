<?php

namespace backend\components;
require_once __DIR__.'/sms.class.php';

Class Sender
{
    public $messageObj;

    public function __construct($login, $passwd)
    {
        $message = new \backend\components\Messages($login,$passwd);
        $this->messageObj = $message;
    }


}