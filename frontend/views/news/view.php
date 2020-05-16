<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <div class="row">
    <?= $model->content?>
    </div>
</div>
