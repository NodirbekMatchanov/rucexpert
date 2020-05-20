<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Список сотрудников';

?>
<div class="site-index">
    <p> <?= Html::a('Создать', 'signup', ['class' => 'btn btn-success']) ?></p>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'first_name',
            'last_name',
            'email',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                ],
        ],
    ]); ?>
</div>
