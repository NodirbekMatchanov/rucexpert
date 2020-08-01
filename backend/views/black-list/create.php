<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BlackList */

$this->title = 'Добавить в реестр';
$this->params['breadcrumbs'][] = ['label' => 'Black Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-create">


    <?php $this->beginBlock('sidebar'); ?>
    <h2><?= $this->title ?></h2>
    <?php $this->endBlock(); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
