<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 10:18
 */

?>

<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper" >
    <div class="header-navbar navbar-expand-sm navbar navbar-horizontal floating-nav navbar-light navbar-without-dd-arrow navbar-shadow menu-border"
         role="navigation" data-menu="menu-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand"
                                                href="../../../html/ltr/horizontal-menu-template/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">Vuexy</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                                class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                                class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                                data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <!-- Horizontal menu content-->
        <div class="navbar-container main-menu-content" data-menu="menu-container">
            <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">

                <?php $menuItems = [
                    [
                        'label' => 'Администрирование',
                        'template' => '<a href="{url}" class="dropdown-toggle nav-link" data-toggle="dropdown"><i ></i><span class="nav-label ">{label}</span> <span
                            class="fa arrow"></span></a>',
                        'url' => '#',
                        'items' => [
                            [
                                'template' => '<a href="{url}" class="dropdown-item">Все пользователи<i class=""></i> <span
                            class=""></span></a>',
                                'url' => ['/admin/user']],
                            [
                                'template' => '<a href="{url}" class="dropdown-item">Назначение<i class=""></i> <span
                            class=""></span></a>',
                                'url' => ['/admin/assignment']],
//                            [
//                                'template' => '<a href="{url}" class="dropdown-item">Роли<i class=""></i> <span
//                            class=""></span></a>',
//                                'url' => ['/admin/role']],
//                            [
//                                'template' => '<a href="{url}" class="dropdown-item">Разрешения<i class=""></i> <span
//                            class=""></span></a>',
//                                'url' => ['/admin/permission']],
//                            [
//                                'template' => '<a href="{url}" class="dropdown-item">Маршруты<i class=""></i> <span
//                            class=""></span></a>',
//                                'url' => ['/admin/route']],
//                        ['label' => 'Правила', 'url' => ['/admin/rule']],
                        ]
                    ],
                    [
                        'label' => 'Новости',
                        'template' => '<a href="{url}" class="dropdown-toggle nav-link" data-toggle="dropdown"><i class="fa fa-newspaper-o"></i><span class="nav-label ">{label}</span> <span
                            class="fa arrow"></span></a>',
                        'url' => '#',
                        'items' => [
                            [
                                'template' => '<a href="{url}" class="dropdown-item">Рубрики<i class=""></i> <span
                            class=""></span></a>', 'url' => ['/rubric/index']],
                            [
                                'template' => '<a href="{url}" class="dropdown-item">Список новостей<i class=""></i> <span
                            class=""></span></a>',
                                'url' => ['/news/index']],
                        ]
                    ],
                    [
                        'label' => 'Реестр',
                          'template' => '<a href="{url}" class="dropdown-item">Реестр<i class=""></i> <span
                            class=""></span></a>',
                        'url' => ['/black-list/index'],
                    ],


                ];
                if (\backend\components\User::getRoleName() != 'admin') {
                    $menuItems = \mdm\admin\components\Helper::filter($menuItems);
                }
                ?>
                <?= backend\widgets\InspiniaMenu::widget([
                    'options' => ['tag' => false],
                    'items' => $menuItems
                ]);
                //              ?>
            </ul>

        </div>
    </div>
</div>
<!-- END: Main Menu-->


