<?php
use frontend\components\Helper;
$this->title = 'Поиск'
?>

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
    <div class="container">
        <div class="row">

            <div class="col-md-12 align-self-center p-static order-2 text-center">

                <h1 class="text-dark font-weight-bold text-8">Результаты поиска: "<?= $q ?>"</h1>
            </div>

            <div class="col-md-12 align-self-center order-1">

                <ul class="breadcrumb d-block text-center">
                    <li><a href="/">Главная</a></li>
                    <li><a href="#">Результаты поиска</a></li>

                </ul>
            </div>
        </div>
    </div>
</section>

<div role="main" class="main pt-3 mt-3">
    <div class="container py-4">

        <div class="row">
            <div class="col">
                <div class="blog-posts">

                    <div class="row">

                        <?php if (!empty($model)): ?>
                            <?php foreach ($model as $item):
                                if(empty($item->img)){
                                   $item->img = '/new_temp/img/not-found.png';
                                } else {
                                    $item->img = '/uploads/news/'.$item->img;
                                }
                                ?>
                                <div class="col-md-4">
                                    <article class="post post-medium border-0 pb-0 mb-5">
                                        <div class="post-image">
                                            <a href="/news/view?id=<?= $item->id ?>">
                                                <img src="<?= $item->img ?>"
                                                     class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0"
                                                     style="width: 550px; height: 250px; object-fit: cover"
                                                     alt="">
                                            </a>
                                        </div>

                                        <div class="post-content">

                                            <h2 class="font-weight-semibold text-5 line-height-6 mt-3 mb-2"><a
                                                    href="/news/view?id=<?= $item->id ?>"><?= $item->title ?></a>
                                            </h2>
                                            <p><?= \yii\helpers\StringHelper::truncate($item->short_content, 180) ?></p>


                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; ?>

                        <?php elseif (empty($model)): ?>
                            <h3>К сожалению, по вашему запросу ничего не найдено.</h3>
                        <?php endif; ?>


                    </div>

                    <div class="text-center py-3 mb-4">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">

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
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>
