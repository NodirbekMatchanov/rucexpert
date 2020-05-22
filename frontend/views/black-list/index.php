<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BlackListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'first_name',
            'last_name',
            'middle_name',
            'moder',
            'type_org',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
