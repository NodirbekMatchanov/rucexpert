<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BlackListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-index">
    <?php if($searchModel->hotel->count_bonus_find):?>
        <h3>У вас <?=$searchModel->hotel->count_bonus_find?> беплатных бонусов</h3>
    <?php endif;?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(!empty($dataProvider)):?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'first_name',
            'last_name',
            'middle_name',

            ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
        ],
    ]); ?>
    <?php else:?>
    <div class="">

    </div>
    <?php endif;?>
</div>
