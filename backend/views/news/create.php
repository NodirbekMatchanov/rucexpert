<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\News */

$this->title = 'Добавить новую запись';
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <?php $this->beginBlock('sidebar'); ?>
    <h2><?= $this->title ?></h2>
    <?php $this->endBlock(); ?>
    <div class="black-list-index">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
