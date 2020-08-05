<?php

use \yii\helpers\Url;

$balance = '';
$img = '/images/avatar-default-icon.png';
$role = \backend\components\User::getRoleName();
if ($role == 'director') {
    $hotel = \common\models\User::findHotel(Yii::$app->user->identity->hotel_id);
    $balance = $hotel->balance . ' РУБ';
    if (!empty($hotel->avatar)) {
        $img = '/uploads/files/' . $hotel->avatar;
    }
}
?>

<header class="header header-nav-menu header-nav-top-line">
    <div class="logo-container">
        <a href="../" class="logo">
            <img src="/new_temp/admin/img/logo.png" width="131" height="35" alt="ruc.expert"/>
        </a>
        <button class="btn header-btn-collapse-nav d-lg-none" data-toggle="collapse" data-target=".header-nav">
            <i class="fas fa-bars"></i>
        </button>
        <!-- start: header nav menu -->
        <div class="header-nav collapse">
            <div class="header-nav-main header-nav-main-effect-1 header-nav-main-sub-effect-1 header-nav-main-square">
                <nav>
                    <ul class="nav nav-pills" id="mainNav">
                        <?php if ($role == 'director' || $role == 'admin'): ?>
                            <li class="<?= (Yii::$app->controller->action->id == 'search') ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= Url::to(['black-list/search']) ?>">
                                    <i class="fa fa-search" aria-hidden="true"></i> Поиск
                                </a>
                            </li>
                        <? endif; ?>
                        <?php if ($role != 'admin'): ?>
                        <li class="<?= (Yii::$app->controller->id . '/' . Yii::$app->controller->action->id == 'black-list/index') ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= Url::to(['black-list/index']) ?>" style="color: red;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Добавить в реестр
                            </a>
                        </li>
                        <? endif; ?>
                        <?php if ($role == 'director'): ?>
                            <li class="<?= (Yii::$app->controller->id . '/' . Yii::$app->controller->action->id == 'personal-area/employe') ? 'active' : '' ?>">
                                <a class="nav-link" href="<?= Url::to(['personal-area/employe']) ?>"
                                   style="color: #0a6aa1;">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Регистрация сотрудников
                                </a>
                            </li>
                        <? endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- end: header nav menu -->
    </div>
    <!-- start: search & user box -->
    <div class="header-right">
        <span class="separator"></span>
        <ul class="notifications">
            <li>
                <a href="#" id="specialButton" class="notification-icon">
                    <i class="fas fa-eye"></i>
                </a>
            </li>
            <li>
                <a href="/feedback" class=" notification-icon" title="">
                    <i class="fas fa-envelope"></i>
                </a>
            </li>
            <li>
                <a href="/" class=" notification-icon">
                    <i class="fas fa-home"></i>
                </a>
            </li>
        </ul>
        <span class="separator"></span>
        <div id="userbox" class="userbox">
            <a href="#" data-toggle="dropdown">
                <?php
                if (!empty($admin_img)):
                    ?>
                    <figure class="profile-picture">
                        <img src="<?= $img ?>" style="object-fit: cover" alt="Joseph Doe" class="rounded-circle"
                             data-lock-picture="img/!logged-user.jpg"/>
                    </figure>
                <?php else: ?>
                    <figure class="profile-picture">
                        <img src="<?= $img ?>" alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?= $img ?>"/>
                    </figure>
                <?php endif; ?>

                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name"><?= Yii::$app->user->identity->username ?></span>
                    <span class="role"><?= $balance ?></span>
                </div>
                <i class="fa custom-caret"></i>
            </a>
            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
                    <li>
                        <a role="menuitem" tabindex="-1" href="<?= Url::to(['personal-area/index']) ?>"><i
                                    class="fas fa-user"></i> Ваш профиль</a>
                    </li>
                    <?php
                    if ($role == 'admin'):?>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?= Url::to(['/admin/black-list/index']) ?>"><i
                                        class="fas fa-cog"></i> Модерация нарушителей</a>
                        </li>
                        <li>
                            <a role="menuitem" tabindex="-1" href="<?= Url::to(['/admin/news/index']) ?>"><i
                                        class="fas fa-cog"></i> Модерация отелей</a>
                        </li>
                        <!--                        <li>-->
                        <!--                            <a role="menuitem" tabindex="-1" href="--><?//= Url::to(['personal-area/index'])
                        ?><!--"><i class="fas fa-cog"></i> Настройки сайта</a>-->
                        <!--                        </li>-->
                    <?php
                    endif; ?>
                    <li>
                        <a role="menuitem" tabindex="-1"
                           href="<?= Url::to(['site/logout?id=' . Yii::$app->user->identity->id]) ?>"><i
                                    class="fas fa-power-off"></i> Выход</a>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>

<!--<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">-->
<!--    <div class="navbar-header d-xl-block d-none">-->
<!--        <ul class="nav navbar-nav flex-row">-->
<!--            <li class="nav-item"><a class="navbar-brand" href="#">-->
<!--                    <div class="brand-logo"></div>-->
<!--                </a></li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <div class="navbar-wrapper">-->
<!--        <div class="navbar-container content">-->
<!--            <div class="navbar-collapse" id="navbar-mobile">-->
<!--                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">-->
<!--                    <ul class="nav navbar-nav">-->
<!--                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a-->
<!--                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i-->
<!--                                        class="ficon feather icon-menu"></i></a></li>-->
<!--                    </ul>-->
<!--                    <ul class="nav navbar-nav">-->
<!--                        <li class="nav navbar-nav bookmark-icons"><a-->
<!--                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i-->
<!--                                        class=" "></i></a></li>-->
<!--                    </ul>-->
<!--                    <ul class="nav navbar-nav">-->
<!--                        <li class="nav navbar-nav bookmark-icons"><a-->
<!--                                    class="nav-link nav-menu-main " href="/personal-area/"><i-->
<!--                                        class=" "></i>Личный кабинет</a></li>-->
<!--                    </ul>-->
<!--                </div>-->
<!--                <ul class="nav navbar-nav float-right">-->
<!---->
<!---->
<!---->
<!--                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"-->
<!--                                                                   href="#" data-toggle="dropdown">-->
<!--                            <div class="user-nav d-sm-flex d-none"><span-->
<!--                                        class="user-name text-bold-600">--><? //= Yii::$app->user->identity->username ?><!--</span>-->
<!--                                <span  class="user-info">--><? //= $balance ?><!-- </span></div>-->
<!--                            <span><img class="round" src="--><? //=$img?><!--"-->
<!--                                       alt="avatar" style="object-fit: cover" height="40" width="40"></span>-->
<!--                        </a>-->
<!--                        <div class="dropdown-menu dropdown-menu-right">-->
<!--                            <a class="dropdown-item" href="--><? //= Url::to(['black-list/search']) ?><!--"><i-->
<!--                                        class="feather icon-user"></i> Быстрый поиск</a>-->
<!--                            <a class="dropdown-item" href="--><? //= Url::to(['site/contact']) ?><!--"><i-->
<!--                                        class="feather icon-user"></i> Написать нам</a>-->
<!--                            <a class="dropdown-item" href="--><? //= Url::to(['personal-area/index']) ?><!--"><i-->
<!--                                        class="feather icon-user"></i> Ваш профиль</a>-->
<!--                            <div class="dropdown-divider"></div>-->
<!--                            <a class="dropdown-item"-->
<!--                               href="--><? //= Url::to(['site/logout?id=' . Yii::$app->user->identity->id]) ?><!--"><i-->
<!--                                        class="feather icon-power"></i>-->
<!--                                Выход</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</nav>-->
