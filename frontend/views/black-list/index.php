<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BlackListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('sidebar'); ?>
<h2><?= $this->title ?></h2>
<?php $this->endBlock(); ?>
<div class="black-list-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <div class="card">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <?= \yii\grid\GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => [
                        'id',
                        'first_name',
                        'last_name',
                        'middle_name',
                        'email',
                        [
                            'label' => 'Статус',
                            'format' => 'raw',
                            'value' => function ($model) {
                                if($model->status != 2){
                                    return '<div class="alert alert-danger btn-sm text-center">на проверке</div>';
                                } else {
                                    return '<div class="alert alert-success btn-sm  text-center btn-sm">опубликовано</div>';
                                }
                            }
                        ],

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view}{update}{delete}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return '<a href="' . Url::to(['view', 'id' => $model->id]) . '" class="kt-nav__link">
								<i class="fa fa-eye"></i>
							</a>';
                                },
                                'update' => function ($url, $model) {
                                    return '<a href="' . Url::to(['update', 'id' => $model->id]) . '" class="kt-nav__link">
								<i class="fa fa-edit"></i>
							</a>';
                                },
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
