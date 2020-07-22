<?php
namespace frontend\widgets;

use common\models\LoginForm;
use yii\base\Widget;
use yii\helpers\Html;

class Header extends Widget
{
    public $items = [];

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        $loginModel = new LoginForm();
        return $this->render('header',['model' => $loginModel]);
    }
}