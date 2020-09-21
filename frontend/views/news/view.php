<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['news/']];
//
//foreach ($rubric as $item) {
//    if ($model->rubric_id == $item->id) {
//        $this->params['breadcrumbs'][] = ['url' => '/news?rubric_id=' . $item->id, 'label' => $item->title];
//    }
//}
$date = \frontend\models\NewsSearch::getMonthString($model->date);
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
    <div class="container">
        <div class="row">

            <div class="col-md-12 align-self-center p-static order-2 text-center">

                <h1 class="text-dark font-weight-bold text-8"><?= $model->title ?></h1>
            </div>

            <div class="col-md-12 align-self-center order-1">

                <ul class="breadcrumb d-block text-center">
                    <li><a href="/news">Главная</a></li>
                    <li><a href="#"> <?= \backend\models\Rubric::getRubricName($model->rubric_id) ?></a></li>

                </ul>
            </div>
        </div>
    </div>
</section>

<div role="main" class="main pt-3 mt-3">
    <div class="container">

        <div class="row pb-1 pt-2">

            <div class="col-md-9">

                <div class="blog-posts single-post">

                    <article class="post post-large blog-single-post border-0 m-0 p-0">
                        <div class="post-image ml-0">
                            <a href="">
                                <img src="/uploads/news/<?= $model->img ?>"
                                     class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" style="width: 1200px;
    height: 500px;
    object-fit: cover;" alt="">
                            </a>
                        </div>

                        <div class="post-date ml-0">
                            <span class="day"><?= $date['day'] ?></span>
                            <span class="month"><?= $date['month'] ?></span>
                        </div>

                        <div class="post-content ml-0">

                            <h2 class="font-weight-bold"><a href=""> <?= $model->title ?> </a></h2>


                            <?= $model->content ?>


                        </div>
                    </article>

                </div>


                <div class="text-center py-3 mb-4">
<!--                    <a href="#"-->
<!--                       target="_blank" class="d-block">-->
<!--                        <img alt="Porto" class="img-fluid pl-3" src="/new_temp/news/img/toyota.gif"/>-->
<!--                    </a>-->
                </div>


            </div>

            <div class="col-md-3">

                <h3 class="font-weight-bold text-3 pt-1">Другие новости</h3>

                <div class="pb-2">

                   <?php if(!empty($otherNews)):?>
                       <?php foreach ($otherNews as $item):?>
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
                                                   <?=date('d.m.Y',strtotime($item['news'][0]['date']))?>
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
                           <?php endif; ?>
                       <?php endforeach;?>
                   <?php endif;?>



                </div>

                <div class="pb-2">


                    <div class="mb-4 pb-2">
<!--                        <img src="/new_temp/news/img/blog/hilton.gif">-->
                    </div>
                </div>


            </div>

        </div>
    </div>

</div>
