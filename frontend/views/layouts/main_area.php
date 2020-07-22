<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AreaAsset;
use common\widgets\Alert;

AreaAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'RUCexpert',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (\yii\helpers\ArrayHelper::isIn(\backend\components\User::getRoleName(),['director','admin' ])) {
        $menuItems[] = ['label' => 'Поиск', 'url' => ['/black-list/search']];
    }
    if (\yii\helpers\ArrayHelper::isIn(\backend\components\User::getRoleName(),['director' ])) {
        $menuItems[] = ['label' => 'Сотрудники', 'url' => ['/personal-area/employe']];
    }
    $menuItems[] = ['label' => 'Добавить в реестр', 'url' => ['/black-list/index']];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/personal-area/index']];
        $menuItems[] = ['label' => 'Логин', 'url' => ['/personal-area/signup']];
    } else {
        $balance = '';
        if(\backend\components\User::getRoleName() == 'director'){
            $hotel = \common\models\User::findHotel(Yii::$app->user->identity->hotel_id);
            $balance = ' Баланс ('.$hotel->balance.') ';
        }
        $menuItems[] = [
            'url' => ['services/index'],
            'options' => ['class' => 'dropdown'],
            'label' => '<span class="fa fa-user">'.$balance.'</span>',
            'items' => [
                ['label' => 'Быстрый поиск', 'url' => ['black-list/search']],
                ['label' => 'Написать нам', 'url' => ['personal-area/facebook']],
                ['label' => 'ВАШ ПРОФИЛЬ', 'url' => ['personal-area/index']],
                [
                    'options' => ['class' => ''],
                    'encode' => false,
                    'label' =>
                        Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Выход',
                            ['class' => ' logout']
                        )
                        . Html::endForm()
                ],

            ],
            'encode' => false
        ];
    }
    $menuItems[] = '<li><a href="#" id="specialButton"><i class="fa fa-eye"></i></a>' . "</li>";
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">RUC EXPERT - Реестр недобросовестных пользователей услугами отелей/хостелами, <br> проката
            автомашин/каршеринга, арендой помещений. </p>

        <p class="pull-right"><?= Html::a('Пользовательское соглашение', '') ?></p>
    </div>
</footer>
<?php $this->endBody() ?>
<script src="https://lidrekon.ru/slep/js/uhpv-full.min.js"></script>
</body>
</html>
<?php $this->endPage() ?>
