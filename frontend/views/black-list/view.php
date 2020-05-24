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
    <div class="card">
        <div class="card-header">
            <h2><?= $model->first_name . ' ' . $model->last_name . ' ' . $model->middle_name ?></h2>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Нарушения</h4>
                    <p class="mb-1 font-small-5">
                        <?= $model->comment ?>
                    </p>
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
        </div>

    </div>
