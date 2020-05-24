<?php

use \yii\helpers\Url;
$balance = '';
if(\backend\components\User::getRoleName() == 'director'){
    $hotel = \common\models\User::findHotel(Yii::$app->user->identity->hotel_id);
    $balance = ' Баланс ('.$hotel->balance.' р) ';
}
?>


<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item"><a class="navbar-brand" href="#">
                    <div class="brand-logo"></div>
                </a></li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                        class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav navbar-nav bookmark-icons"><a
                                    class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                        class=" "></i>Личный кабинет</a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">



                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600"><?= Yii::$app->user->identity->username ?></span>
                                <span  class="user-info"><?= $balance ?> </span></div>
                            <span><img class="round" src="/admin/images/portrait/small/avatar-s-11.jpg"
                                       alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?= Url::to(['black-list/search']) ?>"><i
                                        class="feather icon-user"></i> Быстрый поиск</a>
                            <a class="dropdown-item" href="<?= Url::to(['personal-area/facebook']) ?>"><i
                                        class="feather icon-user"></i> Написать нам</a>
                            <a class="dropdown-item" href="<?= Url::to(['personal-area/index']) ?>"><i
                                        class="feather icon-user"></i> ВАШ ПРОФИЛЬ</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item"
                               href="<?= Url::to(['site/logout?id=' . Yii::$app->user->identity->id]) ?>"><i
                                        class="feather icon-power"></i>
                                Выход</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
