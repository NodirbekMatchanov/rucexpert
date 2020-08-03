<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->beginBlock('sidebar'); ?>
<h2><?= $this->title ?></h2>
<?php $this->endBlock(); ?>
<div class="card">
    <div class="card-body card-dashboard">
<div class="pages-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',
            'url:url',

            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return '<a href="' . Url::to(['update', 'id' => $model->id]) . '" class="kt-nav__link">
								<i class="fa fa-edit"></i>
							</a>';
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<i class=" fa fa-trash"></i>', Url::to(['delete', 'id' => $model->id]), [
                            'data-confirm' => Yii::t('yii', 'Вы точно хотите удалить запись?'),
                            'class' => 'kt-nav__link',
                            'data-method' => 'post',
                        ]);
                    },
                ],
                ],
        ],
    ]); ?>
</div>
