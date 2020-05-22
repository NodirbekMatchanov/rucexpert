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
            <h4>Login: <?= Yii::$app->user->identity->username ?></h4>
            <?php if (\backend\components\User::getRoleName() == 'director'): ?>
                <h4>НАЗВАНИЕ ОРГАНИЗАЦИИ: <?= $hotel->company ?></h4>
                <h4>ТЕЛЕФОН: <?= $hotel->phone ?></h4>
                <h4>Счет: <?= $hotel->balance ?> руб</h4>
            <?php endif; ?>
        </div>
        <div class="story-container log">
            <div class="form-group" style="display: flex; align-items: center">
                <h4 class="">Подключить соцсети</h4>
                <?php echo yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['personal-area/auth'],
                    'popupMode' => false,
                ]) ?>
            </div>
        </div>
    </div>

</div>
