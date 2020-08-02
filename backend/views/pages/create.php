<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Pages */

$this->title = 'Создать страницу';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">

    <div class="card-body">
        <div class="pages-create">

            <?php $this->beginBlock('sidebar'); ?>
            <h2><?= $this->title ?></h2>
            <?php $this->endBlock(); ?>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>

        </div>
    </div>
</div>
