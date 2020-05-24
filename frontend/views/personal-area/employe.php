<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Список сотрудников';

?>
<div class="site-index">
    <p> <?= Html::a('Создать', 'signup', ['class' => 'btn btn-success']) ?></p>


    <div class="card">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => [
                        'id',
                        'first_name',
                        'last_name',
                        'email',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="kt-nav__link-icon fa fa-trash-o"></i>', Url::to(['delete', 'id' => $model->id]), [
                                        'data-confirm' => Yii::t('yii', 'Вы точно хотите удалить запись?'),
                                        'class' => 'kt-nav__link',
                                        'data-method' => 'post',
                                    ]);
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
