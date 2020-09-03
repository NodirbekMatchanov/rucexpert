<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use frontend\components\Helper;

$this->title = 'Новости '. Helper::getRubricWords()[$url];

?>

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
    <div class="container">
        <div class="row">

            <div class="col-md-12 align-self-center p-static order-2 text-center">

                <h1 class="text-dark font-weight-bold text-8"> <?= $this->title ?></h1>
            </div>

            <div class="col-md-12 align-self-center order-1">

                <ul class="breadcrumb d-block text-center">
                    <li><a href="/news">Главная</a></li>
                    <li><a href="#"> <?=  \backend\models\Rubric::getRubricName($rubricId) ?></a></li>

                </ul>
            </div>
        </div>
    </div>
</section>

<div role="main" class="main pt-3 mt-3">
    <div class="container">

        <div class="row pb-1 pt-2">

            <div class="col-md-9">
                <div class="blog-posts">
                    <?php if (!empty($model)): ?>
                        <?php foreach ($model as $key => $item):
                            if(empty($item->img)){
                                $item->img = '/new_temp/img/not-found.png';
                            } else {
                                $item->img = '/uploads/news/'.$item->img;
                            }
                            ?>
                            <article class="post post-medium">
                                <div class="row mb-3">
                                    <div class="col-lg-5">
                                        <div class="post-image">
                                            <a href="/news/view?id=<?= $item->id ?>">
                                                <img src="<?= $item->img ?>"
                                                     class="img-fluid cover-img img-thumbnail img-thumbnail-no-borders rounded-0"
                                                     alt="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="post-content">
                                            <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2">
                                                <a href="/news/view?id=<?= $item->id ?> "><?= $item->title ?> </a>
                                            </h2>
                                            <p class="mb-0">
                                                <?= strip_tags(\yii\helpers\StringHelper::truncate($item->short_content, 250)) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </div>


                <div class="text-center py-3 mb-4">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">

                            <div class="row">
                                <div class="col-md-12 pull-left ">
                                    <?= \yii\widgets\LinkPager::widget([
                                        'pagination' => $pages,
                                    ])
                                    ?>
                                    </p>
                                </div>
                            </div>
                        </ul>
                    </nav>
                </div>


            </div>

            <div class="col-md-3">

                <h3 class="font-weight-bold text-3 pt-1">Другие новости</h3>

                <div class="pb-2">

                    <?php if (!empty($otherNews)): ?>
                        <?php foreach ($otherNews as $item): ?>
                            <?php if(!empty($item['news'])):?>
                                <div class="mb-4 pb-2">
                                    <article
                                            class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <a href="/news?id=<?= $item['news'][0]['id'] ?>">
                                                    <img src="/uploads/news/<?= $item['news'][0]['img'] ?>"
                                                         class="img-fluid border-radius-0"
                                                         alt="<?= $item['news'][0]['title'] ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="thumb-info-caption-text">
                                                    <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                        <?= date('d.m.Y', strtotime($item['news'][0]['date'])) ?>
                                                    </div>
                                                    <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                        <a href="/news/view?id=<?= $item['news'][0]['id'] ?>"
                                                           class="text-decoration-none text-color-dark"><?= $item['news'][0]['title'] ?></a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endif;?>
                        <?php endforeach; ?>
                    <?php endif; ?>


                </div>

                <div class="pb-2">


                    <div class="mb-4 pb-2">

                        <img src="/new_temp/news/img/blog/hilton.gif">
                    </div>

                </div>


            </div>

        </div>
    </div>

</div>

