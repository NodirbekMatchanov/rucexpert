<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BlackListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список';
$this->params['breadcrumbs'][] = $this->title;

$column = [
    [
        'class' => 'yii\grid\CheckboxColumn',
        'name' => 'id',
        'checkboxOptions' => [
                'class' => 'gridSelect'
        ]

    ],
    'id',
    'first_name',
    'last_name',
    'middle_name',
    [
        'label' => 'Автор',
        'format' => 'raw',
        'value' => function ($model) {
            if(\backend\components\User::getRoleName($model->user_id) == 'admin'){
                return 'Admin';
            } else {
                $user = \common\models\User::findOne($model->user_id);
                if(!empty($user)){
                   return $user->username;
                }
            }
            return 'Admin';
        }
    ],
    [
        'label' => 'Статус',
        'format' => 'raw',
        'value' => function ($model) {
            if ($model->status == 0) {
                return '<div class=" alert-primary xs text-center">Новый</div>';
            } elseif($model->status == 2) {
                return '<div class=" alert-success btn-xs text-center">опубликовано</div>';
            } elseif($model->status == 3) {
                return '<div class=" alert-danger btn-xs text-center">Отменено</div>';
            }
        }
    ],
    [
        'label' => 'Рубрика',
        'format' => 'raw',
        'value' => function ($model) {
           return \backend\models\Rubric::getRubricName($model->type_org);
        }
    ],

];
if(\backend\components\User::getRoleName() == 'admin'){
    $columns =  array_merge($column,[[
        'label' => '',
        'format' => 'raw',
        'value' => function ($model) {
            $success = '<button data-id="' . $model->id . ' " class="btn btn-success btn-sm admin-success">Разрешить</button>';
            $error = '<button data-id="' . $model->id . '" class="btn btn-danger btn-sm admin-cancel">Отменить</button>';
            if($model->status == 2){
                return $error;
            } elseif($model->status == 3) {
                return $success;
            } else {
                return $success. ' '. $error;
            }
        }
    ]]);
}
$columns = array_merge($columns, [[
    'class' => 'yii\grid\ActionColumn',
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
            return Html::a('<i class="kt-nav__link-icon fa fa-trash"></i>', Url::to(['delete', 'id' => $model->id]), [
                'data-confirm' => Yii::t('yii', 'Вы точно хотите удалить запись?'),
                'class' => 'kt-nav__link',
                'data-method' => 'post',
            ]);
        },
    ],
]])
?>
<?php $this->beginBlock('sidebar'); ?>
<h2><?= $this->title ?></h2>
<?php $this->endBlock(); ?>
<div class="black-list-index">

    <p>
        <?= Html::a('Добавить новую запись', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Импорт csv', ['import-csv'], ['class' => 'btn btn-primary']) ?>
        <?=Html::a('<i class="kt-nav__link-icon fa fa-trash"> Удалить все</i>', Url::to(['delete-all', 'id' => 'all']), [
            'data-confirm' => Yii::t('yii', 'Вы точно хотите удалить все ?'),
            'class' => 'kt-nav__link btn btn-danger pull-right',
            'data-method' => 'post',
        ])?>
        <?= Html::button('Удалить выбранные',['id' => 'delete_selected_items_btn','class' => ' btn btn-warning hidden'])?>
        <?= Html::button('Разрешить выбранные',['id' => 'accept_selected_items_btn','class' => ' btn btn-success hidden'])?>
    </p>
    <div class="card">
        <div class="card-body card-dashboard">
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,

                    'columns' => $columns,
                    'tableOptions' => ['class' => 'table table-striped dataex-html5-selectors dataTable', 'id' => 'DataTables_Table_4'],
                    'options' => ['class' => ' dataTables_wrapper grid-view dt-bootstrap4', 'id' => 'DataTables_Table_4_wrapper'],

                ]); ?>
            </div>
        </div>
    </div>
</div>
