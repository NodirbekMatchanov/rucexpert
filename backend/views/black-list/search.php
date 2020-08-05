<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BlackListSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Поиск';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card">
    <div class="card-body card-dashboard">

        <div class="black-list-index">
            <?php if (\backend\components\User::getRoleName() != 'admin' && $searchModel->hotel->count_bonus_find): ?>
                <h3>У вас <?= $searchModel->hotel->count_bonus_find ?> беплатных бонусов</h3>
            <?php endif; ?>
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>

            <?php if (!empty($dataProvider)): ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
                    'columns' => [

                        'id',
                        'first_name',
                        'last_name',
                        'middle_name',

                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{view}',
                            'buttons' => [
                                'view' => function ($url, $model) {
                                    return '<a href="' . Url::to(['view', 'id' => $model->id]) . '" class="kt-nav__link">
								<i class="fa fa-eye"></i>
							</a>';
                                },
                            ]
                        ],
                    ],
                ]); ?>
            <?php else: ?>
                <div class="">

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
