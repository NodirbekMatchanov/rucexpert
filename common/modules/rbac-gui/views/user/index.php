<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Все пользователи";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">


    <?php $this->beginBlock('sidebar'); ?>
    <h2><?= $this->title ?></h2>
    <?php $this->endBlock(); ?>
     <?= Html::a('Создать', ['/site/create-user'], ['class' => 'btn btn-success']) ?>
    <br>
    <br>
        <div class="card">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => [
                        'id',
                        'username',
                        'email:email',
                        'created_at:date',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="kt-nav__link-icon fa fa-trash"></i>', Url::to(['delete', 'id' => $model->id]), [
                                        'data-confirm' => Yii::t('yii', 'Вы точно хотите удалить запись?'),
                                        'class' => 'pull-right',
                                        'data-method' => 'post',
                                    ]);
                                }

                            ],
                        ],
                    ],

                ]); ?>
            </div>
        </div>
    </div>

</div>
