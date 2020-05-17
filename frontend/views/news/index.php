<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
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
                    <a href="<?= Url::to(['news/index']) ?>" class="btn btn-default">Очистить Фильтр</a>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-12 col">
            <?php
            if (!empty($newsItems)) {
                foreach ($newsItems

                         as $key => $newsItem):
                    ?>

                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12 col wow fadeInUp" data-wow-delay=".1s">
                            <div class="blog-wrap">
                                <div class="blog-img" style="width: 100%; height: 150px">
                                    <?php if ($newsItem->img != ''): ?>
                                        <?= Html::img('/uploads/news/' . $newsItem->img) ?>
                                    <?php else: ?>
                                        <?= Html::img("/images/notfound.png") ?>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12 col wow fadeInUp line-br">
                            <div class="blog-content ">
                                <h4><b><a href="<?= Url::to(['news/view', 'id' => $newsItem->id]) ?>"><?= $newsItem->title ?></a></b></h4>
                                <p>
                                    <?= \yii\helpers\StringHelper::truncate(Html::encode($newsItem->short_content), '150', '...') ?>
                                </p>
                                <div class="blog-meta pull-right">
                                    <ul>
                                        <li><i class="fa fa-user"></i> <?= $newsItem->creator ?></li>
                                        <li>
                                            <i class="fa fa-calendar"></i>
                                            <?= date("d.m.Y", strtotime($newsItem->date)) ?>
                                        </li>
                                    </ul>
                                </div>

                                <a href="<?= Url::to(['news/view', 'id' => $newsItem->id]) ?>" class=" pull-right ">Подробнее
                                    >></a>

                            </div>
                        </div>
                    </div>

                    <br>
                <?php endforeach;
            } ?>
            <div class="col-md-12 pull-left ">
                <?php
                echo \justinvoelker\separatedpager\LinkPager::widget([
                    'pagination' => $pages,
                    'activePageCssClass' => 'active-page',
                    'prevPageLabel' => false,
                    'nextPageLabel' => false,
                    'maxButtonCount' => 5,
                    'options' => [
                        'class' => 'pagin-list',
                    ]
                ]);

                ?>
                <p>
                    <?php
                    $totalCount = $pages->totalCount;
                    $begin = $pages->getPage() + 1;
                    $count = $pages->pageCount;
                    $end = $totalCount - 4;
                    if ($begin > $end) {
                        $begin = $end;
                    }
                    $page = $pages->getPage() + 1;
                    $pageCount = $pages->pageCount;


                    ?>
                </p>
            </div>
        </div>


    </div>
</div>
