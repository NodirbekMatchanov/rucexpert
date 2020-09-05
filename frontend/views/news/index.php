<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = ['url' => '/news', 'label' => $this->title];
if (Yii::$app->request->get('rubric_id')) {
    foreach ($rubric as $item) {
        if ($item->id == Yii::$app->request->get('rubric_id')) {
            $this->params['breadcrumbs'][] = $item->title;
        }
    }
}
?>
<div role="main" class="main pt-3 mt-3" style="margin-top: 60px!important;">
    <div class="container">
        <div class="row pb-1">
            <?php if (!empty($mainNews)): ?>
                <?php if (empty($mainNews->img)) {
                    $img = '/new_temp/img/not-found.png';
                } else {
                    $img = '/uploads/news/' . $mainNews->img;
                } ?>
                <div class="col-lg-7 mb-4 pb-2">
                    <a href="/news/view?id=<?= $mainNews->id ?>">
                        <article
                                class="thumb-info thumb-info-no-borders thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
                            <div class="thumb-info-wrapper thumb-info-wrapper-opacity-6">
                                <img src="<?= $img ?>" class="img-fluid"
                                     alt="<?= $mainNews->title ?>">
                                <div class="thumb-info-title bg-transparent p-4">
                                    <div class="thumb-info-type bg-color-dark px-2 mb-1"><?= \backend\models\Rubric::getRubricName($mainNews->rubric_id) ?></div>
                                    <div class="thumb-info-inner mt-1">
                                        <h2 class="font-weight-bold text-color-light line-height-2 text-5 mb-0"><?= $mainNews->title ?></h2>
                                    </div>
                                    <div class="thumb-info-show-more-content">
                                        <p class="mb-0 text-1 line-height-9 mb-1 mt-2 text-light opacity-5"><?= $mainNews->short_content ?></p>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </a>
                </div>
            <?php endif; ?>
            <div class="col-lg-5">
                <?php if (!empty($newsItems)): ?>
                    <?php foreach ($newsItems as $categoryNews): ?>
                        <?php if(!empty($categoryNews['news'])):?>
                            <article
                                    class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                                <div class="row align-items-center pb-1">
                                    <div class="col-sm-5">
                                        <?php if (empty($categoryNews['news'][0]['img'])) {
                                            $img = '/new_temp/img/not-found.png';
                                        } else {
                                            $img = '/uploads/news/' . $categoryNews['news'][0]['img'];
                                        } ?>
                                        <a href="/news/view?id=<?= $categoryNews['news'][0]['id'] ?>">
                                            <img src="<?= $img ?>"
                                                 class="img-fluid border-radius-0"
                                                 alt="<?= $categoryNews['news'][0]['title'] ?>" style="object-fit: cover; height: 100px">
                                        </a>
                                    </div>
                                    <div class="col-sm-7 pl-sm-1">
                                        <div class="thumb-info-caption-text">
                                            <div class="thumb-info-type text-light text-uppercase d-inline-block bg-color-dark px-2 m-0 mb-1 float-none">
                                                <a href="/news/view?id=<?= $categoryNews['news'][0]['id'] ?>"
                                                   class="text-decoration-none text-color-light"><?= $categoryNews['title'] ?></a>
                                            </div>
                                            <h2 class="d-block line-height-2 text-4 text-dark font-weight-bold mt-1 mb-0">
                                                <a href="/news/view?id=<?= $categoryNews['news'][0]['id'] ?>"
                                                   class="text-decoration-none text-color-dark"><?= $categoryNews['news'][0]['title'] ?></a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endif;?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="row pb-1 pt-2">

            <div class="col-md-9">

                <?php if (!empty($newsItems)): ?>
                    <?php foreach ($newsItems as $categoryNews): ?>
                        <?php if(!empty($categoryNews['news'])):?>
                            <div class="heading heading-border heading-middle-border">
                                <h3 class="text-4"><strong
                                            class="font-weight-bold text-1 px-3 text-light py-2 bg-tertiary"><?= $categoryNews['title'] ?></strong>
                                </h3>
                            </div>
                            <div class="row pb-1">

                                <div class="col-lg-6 mb-4 pb-1">
                                    <article
                                            class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                        <div class="row">
                                            <div class="col">
                                                <?php if (empty($categoryNews['news'][0]['img'])) {
                                                    $img = '/new_temp/img/not-found.png';
                                                } else {
                                                    $img = '/uploads/news/' . $categoryNews['news'][0]['img'];
                                                } ?>
                                                <a href="/news/view?id=<?= $categoryNews['news'][0]['id'] ?>">
                                                    <img src="<?= $img ?>"
                                                         class="img-fluid border-radius-0"
                                                         alt="<?= $categoryNews['news'][0]['title'] ?>">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="thumb-info-caption-text">
                                                    <div class="d-inline-block text-default text-1 mt-2 float-none">
                                                        <?= date('d.m.Y', strtotime($categoryNews['news'][0]['date'])) ?>
                                                    </div>
                                                    <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                        <a href="/news/view?id=<?= $categoryNews['news'][0]['id'] ?>"
                                                           class="text-decoration-none text-color-dark"><?= $categoryNews['news'][0]['title'] ?></a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <div class="col-lg-6">

                                    <?php foreach ($categoryNews['news'] as $k => $news): ?>
                                        <?php if ($k > 0 && $k < 4):
                                            if (empty($news['img'])) {
                                                $img = '/new_temp/img/not-found.png';
                                            } else {
                                                $img = '/uploads/news/' . $news['img'];
                                            }
                                            ?>
                                            <article
                                                    class="thumb-info thumb-info-side-image thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                                                <div class="row align-items-center pb-1">
                                                    <div class="col-sm-4">
                                                        <a href="/news/view?id=<?= $news['id'] ?>">
                                                            <img src="<?= $img ?>"
                                                                 style="object-fit: cover; width: 150px; height: 70px"
                                                                 class="img-fluid border-radius-0"
                                                                 alt="">
                                                        </a>
                                                    </div>
                                                    <div class="col-sm-8 pl-sm-0">
                                                        <div class="thumb-info-caption-text">
                                                            <div class="d-inline-block text-default text-1 float-none">
                                                                <?= date('d.m.Y', strtotime($news['date'])) ?>
                                                            </div>
                                                            <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                                                <a href="/news/view?id=<?= $news['id'] ?>"
                                                                   class="text-decoration-none text-color-dark"><?= $news['title'] ?></a>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        <?php endif; ?>
                                    <?php endforeach; ?>


                                </div>
                            </div>
                        <?php endif;?>
                    <?php endforeach; ?>
                <?php endif; ?>


                <div class="text-center py-3 mb-4">
<!--                    <a href="#"-->
<!--                       target="_blank" class="d-block">-->
<!--                        <img alt="Porto" class="img-fluid pl-3" src="/new_temp/news/img/toyota.gif"/>-->
<!--                    </a>-->
                </div>


            </div>

            <div class="col-md-3">


                <div class="pb-2">


                    <div class="mb-4 pb-2">
<!--                        <img src="/new_temp/news/img/blog/hilton.gif">-->
                    </div>
                </div>


            </div>

        </div>
    </div>

</div>
