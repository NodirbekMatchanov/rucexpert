<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 10:18
 */

?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header skin-3">
                <div class="dropdown profile-element"> <span>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong
                                            class="font-bold"><?= Yii::$app->user->identity->username ?></strong>
                             </span>
                                <!--                                <span class="text-muted text-xs block"><b class="caret"></b></span>-->
                            </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <!--                        <li><a href="profile.html">Profile</a></li>-->
                        <!--                        <li><a href="contacts.html">Contacts</a></li>-->
                        <!--                        <li><a href="mailbox.html">Mailbox</a></li>-->
                        <!--                        <li class="divider"></li>-->
                        <!--                        <li><a href="login.html">Logout</a></li>-->
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <?php $menuItems = [
                [
                    'label' => 'Администрирование',
                    'template' => '<a href="{url}"><i class="fa fa-bars"></i><span class="nav-label ">{label}</span> <span
                            class="fa arrow"></span></a>',
                    'url' => '#',
                    'items' => [
                        [
                            'template' => '<a href="{url}">Все пользователи<i class=""></i> <span
                            class=""></span></a>',
                            'url' => ['/admin/user']],
                        [
                            'template' => '<a href="{url}">Назначение<i class=""></i> <span
                            class=""></span></a>',
                            'url' => ['/admin/assignment']],
                        [
                            'template' => '<a href="{url}">Роли<i class=""></i> <span
                            class=""></span></a>',
                            'url' => ['/admin/role']],
                        [
                            'template' => '<a href="{url}">Разрешения<i class=""></i> <span
                            class=""></span></a>',
                            'url' => ['/admin/permission']],
                        [
                            'template' => '<a href="{url}">Маршруты<i class=""></i> <span
                            class=""></span></a>',
                            'url' => ['/admin/route']],
//                        ['label' => 'Правила', 'url' => ['/admin/rule']],
                    ]
                ],
                [
                    'label' => 'Новости',
                    'template' => '<a href="{url}"><i class="fa fa-newspaper-o"></i><span class="nav-label ">{label}</span> <span
                            class="fa arrow"></span></a>',
                    'url' => '#',
                    'items' => [
                        [
                            'template' => '<a href="{url}">Рубрики<i class=""></i> <span
                            class=""></span></a>', 'url' => ['/rubric/index']],
                        [
                            'template' => '<a href="{url}">Список новостей<i class=""></i> <span
                            class=""></span></a>',
                            'url' => ['/news/index']],
                    ]
                ],


            ];
            if (\backend\components\User::getRoleName() != 'admin') {
                $menuItems = \mdm\admin\components\Helper::filter($menuItems);
            }
            ?>


            <?= backend\widgets\InspiniaMenu::widget([
                'options' => ['tag' => false],
                'items' => $menuItems,
                'submenuTemplate' => "\n<ul class='nav nav-second-level collapse out'>\n{items}\n</ul>\n",
            ]);
            ?>
        </ul>

    </div>
</nav>
