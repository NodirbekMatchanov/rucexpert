<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BlackList */

$this->title = 'ДОБАВИТЬ В РЕЕСТР';
$this->params['breadcrumbs'][] = ['label' => 'Список', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
