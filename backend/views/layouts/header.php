<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 09:47
 */
?>


<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-fixed navbar-shadow navbar-brand-center" >
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
                                        class=" "></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav">
                        <li class="nav navbar-nav bookmark-icons"><a
                                    class="nav-link nav-menu-main" href="/admin/"><i
                                        class=" "></i>Админ панель</a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">


<!--                    <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#"-->
<!--                                                                           data-toggle="dropdown"><i-->
<!--                                    class="ficon feather icon-bell"></i><span-->
<!--                                    class="badge badge-pill badge-primary badge-up">1</span></a>-->
<!--                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">-->
<!--                            <li class="dropdown-menu-header">-->
<!--                                <div class="dropdown-header m-0 p-2">-->
<!--                                    <h3 class="white">1 New</h3><span-->
<!--                                            class="notification-title">App Notifications</span>-->
<!--                                </div>-->
<!--                            </li>-->
<!--                            <li class="scrollable-container media-list"><a class="d-flex justify-content-between"-->
<!--                                                                           href="javascript:void(0)">-->
<!---->
<!--                               <a class="d-flex justify-content-between" href="javascript:void(0)">-->
<!--                                    <div class="media d-flex align-items-start">-->
<!--                                        <div class="media-left"><i class="feather icon-file font-medium-5 warning"></i>-->
<!--                                        </div>-->
<!--                                        <div class="media-body">-->
<!--                                            <h6 class="warning media-heading">Generate monthly report</h6><small-->
<!--                                                    class="notification-text">Chocolate cake oat cake tiramisu-->
<!--                                                marzipan</small>-->
<!--                                        </div>-->
<!--                                        <small>-->
<!--                                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last month-->
<!--                                            </time>-->
<!--                                        </small>-->
<!--                                    </div>-->
<!--                                </a></li>-->
<!--                            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center"-->
<!--                                                                href="javascript:void(0)">Read all notifications</a>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                                                                   href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                        class="user-name text-bold-600"><?= Yii::$app->user->identity->username ?></span><span
                                        class="user-status"><?= Yii::$app->user->identity->email ?></span></div>
                            <span><img class="round" src="/admin/images/portrait/small/avatar-s-11.jpg"
                                       alt="avatar" height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item"
                                                                          href="page-user-profile.html"><i
                                        class="feather icon-user"></i> Настройка</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/admin/site/logout?id=<?= Yii::$app->user->identity->id ?>"><i
                                        class="feather icon-power"></i>
                                Выход</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
