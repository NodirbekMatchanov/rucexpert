<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\models\BlackListSearch */

$this->title = 'Просмотр';
$this->params['breadcrumbs'][] = ['url' => 'index', 'label' => 'ДОБАВИТЬ В РЕЕСТР'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="black-list-index">
    <div class="card">
        <div class="card-header">
            <h2><?= $model->first_name . ' ' . $model->last_name . ' ' . $model->middle_name ?></h2>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <h4 class="alert-heading">Нарушения</h4>
                    <p class="mb-1 font-small-5">
                        <?= $model->comment ?>
                    </p>
                </div>
                <h3>Галерея</h3>
                <?=
                newerton\fancybox\FancyBox::widget([
                    'target' => 'a[rel=fancybox]',
                    'helpers' => true,
                    'mouse' => true,
                    'config' => [
                        'maxWidth' => '90%',
                        'maxHeight' => '90%',
                        'playSpeed' => 7000,
                        'padding' => 0,
                        'fitToView' => false,
                        'width' => '70%',
                        'height' => '70%',
                        'autoSize' => false,
                        'closeClick' => false,
                        'openEffect' => 'elastic',
                        'closeEffect' => 'elastic',
                        'prevEffect' => 'elastic',
                        'nextEffect' => 'elastic',
                        'closeBtn' => false,
                        'openOpacity' => true,
                        'helpers' => [
                            'title' => ['type' => 'float'],
                            'buttons' => [],
                            'thumbs' => ['width' => 68, 'height' => 50],
                            'overlay' => [
                                'css' => [
                                    'background' => 'rgba(0, 0, 0, 0.8)'
                                ]
                            ]
                        ],
                    ]
                ]);
                ?>
                <?php $i = 0;
                if ($model->files): ?>
                  <div class="row">
                    <?php foreach ($model->files as $file): $i++; ?>
                        <div class="col-sm-3 col-md-3 col-xl-3 col-xs-12">

                            <?= Html::a(Html::img('/uploads/black-list/' . $file->url, ['style' => 'width:100%; height: 200px; margin:10px; object-fit:cover;']), '/uploads/black-list/' . $file->url, ['rel' => 'fancybox']);
                            ?>
                        </div>


                    <?php endforeach; ?>
                  </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>
