<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    'id',
    'title',
    'date',
    [
        'label' => 'Статус',
        'format' => 'raw',
        'value' => function ($model) {
            if ($model->status == 0) {
                return '<div class="alert alert-primary btn-sm text-center">Новый</div>';
            } elseif ($model->status == 2) {
                return '<div class="alert alert-success btn-sm text-center">опубликовано</div>';
            } elseif ($model->status == 3) {
                return '<div class="alert alert-danger btn-sm text-center">Отменено</div>';
            }
        }
    ],

];
// поле модерация толтко для админа
if (\backend\components\User::getRoleName() == 'admin') {
    $columns = array_merge($columns, [[
        'label' => '',
        'headerOptions' => ['style' => 'width:10%'],
        'format' => 'raw',
        'value' => function ($model) {
            $success = '<button data-id="' . $model->id . ' " class="btn btn-success btn-sm news-success text-center" style="margin-bottom: 5px">Разрешить</button>';
            $error = '<button data-id="' . $model->id . '" class="btn btn-danger btn-sm news-cancel text-center" >Отменить</button>';
            if ($model->status == 2) {
                return $error;
            } elseif ($model->status == 3) {
                return $success;
            } else {
                return $success . ' ' . $error;
            }
        }
    ]]);
}

$columns = array_merge($columns, [[
    'class' => 'yii\grid\ActionColumn',
    'buttons' => [
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
]]);
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новую запись', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="card">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => $columns,
                    'tableOptions' => ['class' => 'table table-striped dataex-html5-selectors dataTable', 'id' => 'DataTables_Table_4'],
                    'options' => ['class' => ' dataTables_wrapper dt-bootstrap4', 'id' => 'DataTables_Table_4_wrapper'],

                ]); ?>
            </div>
        </div>
    </div>
</div>
