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
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                             </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Mailbox</a></li>
                        <li class="divider"></li>
                        <li><a href="login.html">Logout</a></li>
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
                        ['label' => 'Все пользователи', 'url' => ['/admin/user']],
                        ['label' => 'Назначение', 'url' => ['/admin/assignment']],
                        ['label' => 'Роли', 'url' => ['/admin/role']],
                        ['label' => 'Разрешения', 'url' => ['/admin/permission']],
                        ['label' => 'Маршруты', 'url' => ['/admin/route']],
                        ['label' => 'Правила', 'url' => ['/admin/rule']],
                    ]
                ],
                [
                    'label' => 'Новости',
                    'template' => '<a href="{url}"><i class="fa fa-maps-marker"></i><span class="nav-label ">{label}</span> <span
                            class="fa arrow"></span></a>',
                    'url' => '#',
                    'items' => [
                        ['label' => 'Рубрики', 'url' => ['/rubric/index']],
                        ['label' => 'Список новостей', 'url' => ['/news/index']],
                    ]
                ],


            ];
//            $menuItems = \mdm\admin\components\Helper::filter($menuItems)
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
