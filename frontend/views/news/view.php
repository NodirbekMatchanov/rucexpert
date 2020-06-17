<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news/']];

foreach ($rubric as $item) {
    if ($model->rubric_id == $item->id) {
        $this->params['breadcrumbs'][] = ['url' => '/news?rubric_id=' . $item->id, 'label' => $item->title];
    }
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-12 col">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>НОВОСТИ</h4>

                </div>
                <div class="panel-body">
                    <?= Html::ul($rubric, [
                        'item' => function ($item) {
                            return Html::tag(
                                'li',
                                $this->render('left_menu', ['item' => $item])
                            );
                        }, 'class' => 'left-menu']) ?>
                    <a href="<?= Url::to(['news/index']) ?>" class="btn btn-default">ВСЕ НОВОСТИ</a>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 col-xs-12 col wow fadeInUp line-br">
            <?= $model->content ?>
            <?php if ($model->is_video): ?>
                <h4>Видео к материалу</h4>
            <?php endif; ?>
            <?php if ($model->video != ''): ?>
                <div class="row">

                    <div style="display: flex;
    justify-content: space-around;">
                        <?= $model->video ?>
                    </div>
                </div>
            <?php endif; ?>
            <br>
            <?php if (!empty($video)): ?>
                <div class="row">
                    <div style="display: flex;
    justify-content: space-around;">
                        <video width="620"  controls>
                            <source src="/uploads/news/video/<?= $video->url ?>" type="video/mp4">
                        </video>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
