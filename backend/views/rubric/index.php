<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RubricSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Рубрики';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubric-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать рубрик', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="card">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => [
                        'id',
                        'title',
                        'price',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}{update}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="kt-nav__link-icon fa fa-trash-o"></i>', Url::to(['delete', 'id' => $model->id]), [
                                        'data-confirm' => Yii::t('yii', 'Вы точно хотите удалить запись?'),
                                        'class' => 'pull-right',
                                        'data-method' => 'post',
                                    ]);
                                },
                                'update' => function ($url, $model) {
                                    return '<a href="' . Url::to(['update', 'id' => $model->id]) . '" class="pull-right " style="margin-right: 10px">
								<i class="fa fa-edit"></i>
							</a>';
                                },

                            ],
                        ],
                    ],
                    'tableOptions' => ['class' => 'table table-striped dataex-html5-selectors dataTable', 'id' => 'DataTables_Table_4'],
                    'options' => ['class' => ' dataTables_wrapper dt-bootstrap4', 'id' => 'DataTables_Table_4_wrapper'],

                ]); ?>
            </div>
        </div>
    </div>
</div>
