<?php

use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<?php if(Yii::$app->controller->action->id == 'index' && Yii::$app->controller->id == 'site'):?>

<header id="header" class="header-effect-shrink"
        data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
    <div class="header-body border-top-0 ">
        <div class="header-top header-top-borders header-top-light-2-borders">
            <div class="container container-lg h-100">
                <div class="header-row h-100">
                    <div class="header-column justify-content-start">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="nav-item nav-item-borders py-2 d-none d-md-inline-flex">
                                        <?php if (Yii::$app->user->isGuest): ?>
                                            <a href="#" class="authorization"><span class="pl-0"><i
                                                            class="fa fa-search text-4  text-color-primary"
                                                            style="top: 1px;"></i> Поиск</span></a>
                                        <?php else: ?>
                                            <a href="/black-list/search"><span class="pl-0"><i
                                                            class="fa fa-search text-4 text-color-primary"
                                                            style="top: 1px;"></i> Поиск</span></a>
                                        <?php endif; ?>
                                    </li>

                                    <li class="nav-item nav-item-borders py-2 d-none d-md-inline-flex">
                                        <a href="mailto:info@ruc.expert"><i
                                                    class="far fa-envelope text-4 text-color-primary"
                                                    style="top: 1px;"></i> info@ruc.expert</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills" style="align-items: center">
                                    <li class="nav-item nav-item-borders py-2 pr-0 dropdown">
                                        <button class="btn btn-modern btn-primary btn-xs" data-toggle="modal"
                                                data-target="#defaultModal"
                                                style="text-align: center;background: green;border-color: green;">
                                            Выбор языка
                                        </button>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-container container" style="height: 100px; min-height: 0px;">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a href="/">
                                <img style="height: 50px;" alt="Ruc Expert" src="/new_temp/news/img/logo-png.png">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                <nav class="collapse">
                                    <ul class="nav nav-pills" id="mainNav">
                                        <li class="dropdown">
                                            <a class="dropdown-item dropdown-toggle" href="<?= Url::to(['/']) ?>">Главная<i class="fas fa-chevron-down"></i></a>
                                        </li>
                                        <li class="dropdown dropdown-mega">
                                            <a class="dropdown-item dropdown-toggle" href="<?= Url::to(['/news']) ?>">Новости<i class="fas fa-chevron-down"></i></a>
                                        </li>
                                        <li class="dropdown dropdown-mega">
                                            <a class="dropdown-item dropdown-toggle" href="<?= Url::to(['site/about']) ?>">О проекте<i class="fas fa-chevron-down"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                    data-target=".header-nav-main nav">
                                <i class="fas fa-bars"></i>
                            </button>
                        </div>
                        <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                            <div class="header-nav-feature header-nav-features-user d-inline-flex mx-2 pr-2 signin"
                                 id="headerAccount">
                                <?php if (Yii::$app->user->isGuest): ?>

                                    <a href="#" class="header-nav-features-toggle login">
                                        <i class="far fa-user"></i> Вход
                                    </a>
                                    <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right"
                                         id="headerTopUserDropdown">
                                        <div class="signin-form">
                                            <?php echo $this->render('@app/views/site/login', ['model' => $model]); ?>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <a href="#" class="header-nav-features-toggle">
                                        <i class="far fa-user"></i> <?= Yii::$app->user->identity->username ?>
                                    </a>
                                    <div class="header-nav-features-dropdown header-nav-features-dropdown-mobile-fixed header-nav-features-dropdown-force-right"
                                         id="headerTopUserDropdown">
                                        <div class="row">
                                            <div class="col-8">
                                                <p class="mb-0 pb-0 text-2 line-height-1 pt-1">Привет!,</p>
                                                <p>
                                                    <strong class="text-color-dark text-4"><?= Yii::$app->user->identity->username ?></strong>
                                                </p>
                                            </div>
                                            <div class="col-4">
                                                <div class="d-flex justify-content-end">
                                                    <img class="rounded-circle" width="40" height="40" alt=""
                                                         src="img/avatars/avatar.jpg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <ul class="nav nav-list-simple flex-column text-3">
                                                    <li class="nav-item">
                                                        <a class="nav-link"
                                                           href="<?= Url::to(['personal-area/index']) ?>"><i
                                                                    class="fas fa-user"></i> Ваш профиль</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link border-bottom-0" tabindex="-1"
                                                           href="<?= Url::to(['site/logout?id=' . Yii::$app->user->identity->id]) ?>"><i
                                                                    class="fas fa-power-off"></i> Выход</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<?php else:?>
    <header id="header" style="margin-bottom: 40px"
            data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 122, 'stickySetTop': '-122px', 'stickyChangeLogo': false}">
        <div class="header-top header-top-borders header-top-light-2-borders">
            <div class="container container-lg h-100">
                <div class="header-row h-100">
                    <div class="header-column justify-content-start">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills">
                                    <li class="nav-item nav-item-borders py-2 d-none d-md-inline-flex">
                                        <span class="pl-0"><i class="fa fa-search text-4 text-color-primary"
                                                              style="top: 1px;"></i> Поиск</span>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2">
                                        <a href="tel:123-456-7890"><i class="far fa-user text-4 text-color-primary"
                                                                      style="top: 0;"></i>Авторизация</a>
                                    </li>
                                    <li class="nav-item nav-item-borders py-2 d-none d-md-inline-flex">
                                        <a href="mailto:info@ruc.expert"><i
                                                    class="far fa-envelope text-4 text-color-primary"
                                                    style="top: 1px;"></i> info@ruc.expert</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <nav class="header-nav-top">
                                <ul class="nav nav-pills" style="align-items: center">
                                    <li class="nav-item nav-item-borders py-2">
                                        <a href="<?= Url::to(['/news']) ?>"><i class="far fa-newspaper text-4 text-color-primary"
                                                               style="top: 0;"></i>Новости</a>
                                    </li>

                                    <li class="nav-item nav-item-borders py-2 pr-0 dropdown">

                                        <button class="btn btn-modern btn-primary btn-xs" data-toggle="modal"
                                                data-target="#defaultModal">
                                            Выбор языка
                                        </button>


                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-body border-color-primary border-top-0 box-shadow-none">
            <div class="header-container container z-index-2" style="min-height: 122px;">
                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <h1 class="header-logo">
                                <a href="/">
                                    <img alt="Porto" width="100%" src="/new_temp/news/img/logo-black.png">
                                    <span class="hide-text">Porto - Demo Blog 5</span>
                                </a>
                            </h1>
                        </div>
                    </div>
                    <div class="header-column justify-content-end mobile-hidden">
                        <div class="header-row h-100">
                            <a href="#"
                               target="_blank" class="py-3 d-block">
                                <img alt="Porto" class="img-fluid pl-3" src="/new_temp/news/img/blog/mariott.gif"/>
                            </a>
                        </div>
                    </div>
                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <div class="header-nav header-nav-links header-nav-dropdowns-dark header-nav-light-text order-2 order-lg-1">
                                <div class="mobile-nav hidden header-nav-main mobile header-nav-main-mobile-dark header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills mobile-ul " id="mainNav">
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle "
                                                   href="<?= Url::to(['/']) ?>">
                                                    Главная
                                                </a>

                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light dropdown-mega">
                                                <a class="dropdown-item dropdown-toggle "
                                                   href="<?= Url::to(['/news']) ?>">
                                                    Все новости
                                                </a>

                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light dropdown-mega">
                                                <a class="dropdown-item dropdown-toggle "
                                                   href="<?= Url::to(['/karshering']) ?>">
                                                    Каршеринг
                                                </a>

                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle "
                                                   href="/news-hotels">
                                                    Отели / Хостелы
                                                </a>

                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle "
                                                   href="/news-rent">
                                                    Аренда
                                                </a>

                                            </li>
                                            <li class="dropdown dropdown-full-color dropdown-light">
                                                <a class="dropdown-item dropdown-toggle" href="#">
                                                    Добавить новость
                                                </a>

                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                        data-target=".header-nav-main.mobile nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="header-nav-bar bg-primary mobile-hidden">
                <div class="container">
                    <div class="header-row p-relative">
                        <div class="header-column">
                            <div class="header-row">
                                <div class="header-colum order-2 order-lg-1">
                                    <div class="header-row">
                                        <div class="header-nav header-nav-stripe header-nav-divisor header-nav-force-light-text justify-content-start">
                                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-1 header-nav-main-sub-effect-1">
                                                <nav class="collapse">
                                                    <ul class="nav nav-pills" id="mainNav">
                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a class="dropdown-item dropdown-toggle "
                                                               href="/">
                                                                Главная
                                                            </a>

                                                        </li>
                                                        <li class="dropdown dropdown-full-color dropdown-light dropdown-mega">
                                                            <a class="dropdown-item dropdown-toggle"
                                                               href="/news">
                                                                Все новости
                                                            </a>

                                                        </li>
                                                        <li class="dropdown dropdown-full-color dropdown-light dropdown-mega">
                                                            <a class="dropdown-item dropdown-toggle "
                                                               href="<?= Url::to(['/news/karshering']) ?>">
                                                                Каршеринг
                                                            </a>

                                                        </li>
                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a class="dropdown-item dropdown-toggle "
                                                               href="<?= Url::to(['/news/hotel']) ?>">
                                                                Отели / Хостелы
                                                            </a>

                                                        </li>
                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a class="dropdown-item dropdown-toggle "
                                                               href="<?= Url::to(['/news/rent']) ?>">
                                                                Аренда
                                                            </a>

                                                        </li>
                                                        <li class="dropdown dropdown-full-color dropdown-light">
                                                            <a class="dropdown-item dropdown-toggle "
                                                               href="<?= Url::to(['/news/car-rent']) ?>">
                                                                Арендовать авто
                                                            </a>

                                                        </li>
<!--                                                        -->
<!--                                                        <li class="dropdown dropdown-full-color dropdown-light">-->
<!--                                                            <a class="dropdown-item dropdown-toggle" href="#">-->
<!--                                                                Добавить новость-->
<!--                                                            </a>-->
<!---->
<!--                                                        </li>-->

                                                    </ul>
                                                </nav>
                                            </div>
                                            <button class="btn header-btn-collapse-nav" data-toggle="collapse"
                                                    data-target=".header-nav-main nav">
                                                <i class="fas fa-bars"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="header-column order-1 order-lg-2">
                                    <div class="header-row justify-content-end">
                                        <div class="header-nav-features header-nav-features-no-border w-75 w-auto-mobile d-none d-sm-flex">
                                            <?php $form = ActiveForm::begin(['id' => 'login-form','action' => 'search']); ?>
                                            <div class="simple-search input-group w-100">
                                                <input class="form-control border-0 text-1" id="headerSearch"
                                                           name="search" type="search" value=""
                                                           placeholder="Поиск новостей...">
                                                    <span class="input-group-append bg-light border-0">
																<button class="btn" type="submit">
																	<i class="fa fa-search header-nav-top-icon"></i>
																</button>
															</span>
                                                </div>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
<?php endif;?>
