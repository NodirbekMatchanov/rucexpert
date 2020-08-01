<?php

use yii\helpers\Url;

$img = '/images/avatar-default-icon.png';

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

                            <?php $menuItems = [
                                [
                                    'label' => 'Администрирование',
                                    'template' => '<a href="{url}" class="dropdown-toggle nav-link" data-toggle="dropdown"><i ></i><span class="nav-label ">{label}</span> <span
                            class=" "></span></a>',
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
                            class=" "></span></a>',
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

                    <figure class="profile-picture">
                        <img src="<?= $img ?>" alt="Joseph Doe" class="rounded-circle" data-lock-picture="<?= $img ?>"/>
                    </figure>

                <span><?=Yii::$app->user->identity->username?> </span> <i class="fa custom-caret"></i>
            </a>
            <div class="dropdown-menu">
                <ul class="list-unstyled">
                    <li class="divider"></li>
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