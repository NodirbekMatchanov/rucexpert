<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Rubric */

$this->title = 'Создать рубрик';
$this->params['breadcrumbs'][] = ['label' => 'Rubrics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rubric-create">


    <?php $this->beginBlock('sidebar'); ?>
    <h2><?= $this->title ?></h2>
    <?php $this->endBlock(); ?>
    <div class="black-list-index">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
