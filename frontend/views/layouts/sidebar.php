<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 10:18
 */

?>

<!-- BEGIN: Main Menu-->
<div class="horizontal-menu-wrapper">
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

                <?php
                if (\yii\helpers\ArrayHelper::isIn(\backend\components\User::getRoleName(), ['director'])) {
                    $menuItems[] =
                        [
                            'label' => 'Сотрудники',
                            'template' => '<a href="{url}" class="" ><i ></i><span class="nav-label fa fa-users"> {label}</span> </a>',
                            'url' => '/personal-area/employe',

                        ];
                }
                if (\yii\helpers\ArrayHelper::isIn(\backend\components\User::getRoleName(), ['director', 'admin'])) {
                    $menuItems[] = [
                        'label' => 'Поиск',
                        'template' => '<a href="{url}" class="" ><i ></i><span class="nav-label fa fa-search"> {label}</span> </a>',
                        'url' => '/black-list/search',

                    ];
                }
                $menuItems[] = [
                    'label' => 'Добавить в реестр',
                    'template' => '<a href="{url}" class="" ><i ></i><span class="nav-label fa fa-plus"> {label}</span></a>',
                    'url' => '/black-list/index',

                ];

                ?>
                <?= backend\widgets\InspiniaMenu::widget([
                    'options' => ['tag' => false],
                    'items' => $menuItems
                ]);
                //                ?>
            </ul>

        </div>
    </div>
</div>
<!-- END: Main Menu-->


