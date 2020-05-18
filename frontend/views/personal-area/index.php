<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Поиск';

?>
<div class="site-index">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3>Личный кабинет</h3>
        </div>
        <div class="panel panel-body">
            <h4>Login: <?=Yii::$app->user->identity->username?></h4>
            <h4>НАЗВАНИЕ ОРГАНИЗАЦИИ: <?=$hotel->company?></h4>
            <h4>ТЕЛЕФОН: <?=$hotel->phone?></h4>
        </div>
    </div>

</div>
