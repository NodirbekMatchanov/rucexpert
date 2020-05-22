<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\BlackListSearch */

$this->title = 'Просмотр';
$this->params['breadcrumbs'][] = ['url' => 'index', 'label' => 'ДОБАВИТЬ В РЕЕСТР'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-index">

    <h2><?= $model->first_name . ' ' . $model->last_name . ' ' . $model->middle_name ?></h2>
    <div class="panel panel-warning">
        <div class="panel panel-heading">
            <h3>Нарушения</h3>
        </div>
        <div class="panel-body">
            <?= $model->comment ?>
        </div>
    </div>
    <h3>Файлы</h3>
    <?php $i = 0;
    if ($model->files): ?>
        <?php foreach ($model->files as $file): $i++; ?>
            <?= Html::a('file № ' . $i, 'web/upload/black-list/' . $file->url, ['download' => '']) ?>
        <br>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
