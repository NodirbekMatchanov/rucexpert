<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BlackList */

$this->title = 'Редактирование: ' . $model->first_name. ' '. $model->last_name. ' '. $model->middle_name;
$this->params['breadcrumbs'][] = ['label' => 'Black Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="black-list-update">
    <?php $this->beginBlock('sidebar'); ?>
    <h2><?= $this->title ?></h2>
    <?php $this->endBlock(); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
