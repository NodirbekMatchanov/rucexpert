<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

?>
<div class="verify-email">
    <p>Зарегистрирован пользовтель <?= Html::encode($user->username) ?></p>

    <p>Компания: <?=$hotel->company?></p>
</div>
