<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\NewAppAsset;
use common\widgets\Alert;

NewAppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400"
          rel="stylesheet" type="text/css">
    <script type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <?php $this->head() ?>
</head>
<body class="loading-overlay-showing" data-plugin-page-transition data-loading-overlay
      data-plugin-options="{'hideDelay': 500}">
<?php $this->beginBody() ?>
<div class="loading-overlay">
    <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<div class="body">

    <?php
    $menuItems = [
        ['label' => 'Главная страница', 'url' => ['/site/index']],
        $menuItems[] = ['label' => 'Поиск', 'url' => ['black-list/search']]
    ];
    ?>

    <?= \frontend\widgets\Header::widget(['items' => $menuItems]) ?>
    <?= \diecoding\toastr\ToastrFlash::widget(); ?>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <p class="mb-0">
                <?= Yii::$app->session->getFlash('success') ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">
                <?= Yii::$app->session->getFlash('error') ?>
            </p>
        </div>
    <?php endif; ?>
    <!--  Если главная страница то контейнер не нужно  -->
    <?php if (
        Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'index'
        || Yii::$app->controller->id == 'news' && Yii::$app->controller->action->id == 'view'
        || Yii::$app->controller->id == 'news' && Yii::$app->controller->action->id != 'index'
    ) : ?>
        <?= $content ?>
    <?php else: ?>
        <div class="container">
            <?= $content ?>
        </div>
    <?php endif; ?>
</div>

<footer id="footer" class="mt-0">
    <div class="container container-lg my-4">
        <div class="row py-4">
            <div class="col-lg-4 mb-4 mb-md-0 text-center text-lg-left pt-4">
                <h5 class="text-5 text-transform-none font-weight-semibold text-color-dark mb-4">Личный кабинет</h5>
                <ul class="list list-icons list-icons-sm d-inline-flex flex-column">
                    <li class="text-4 mb-2"><a href="/site/login" class="link-hover-style-1 ml-1"> Авторизация</a>
                    </li>
                    <li class="text-4 mb-2"><a href="#" data-toggle="modal" data-target="#signModal"
                                               class="link-hover-style-1 ml-1">
                            Регистрация</a></li>
                    <li class="text-4 mb-2"><a href="/personal-area/index" class="link-hover-style-1 ml-1"> Личный
                            кабинет</a></li>
                    <li class="text-4 mb-2"><a href="/black-list/search" class="link-hover-style-1 ml-1"> Поиск
                            нарушителя</a></li>
                </ul>
            </div>
            <div class="col-lg-4 mb-4 mb-md-0 text-center text-lg-left pt-4">
                <h5 class="text-5 text-transform-none font-weight-semibold text-color-dark mb-4">О нас</h5>
                <ul class="list list-icons list-icons-sm d-inline-flex flex-column">
                    <li class="text-4 mb-2"><a href="/about" class="link-hover-style-1 ml-1"> О проекте</a></li>
                    <li class="text-4 mb-2"><a href="/license" class="link-hover-style-1 ml-1"> Правила пользования
                            сервисом</a></li>
                    <li class="text-4 mb-2"><a href="/personal-data" class="link-hover-style-1 ml-1"> Обработка
                            персональных
                            данных</a></li>
                    <li class="text-4 mb-2"><a href="/politic" class="link-hover-style-1 ml-1"> Политика
                            конфиденциальности</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 mb-4 mb-md-0 text-center text-lg-left pt-4">
                <h5 class="text-5 text-transform-none font-weight-semibold text-color-dark mb-4">Информация</h5>
                <ul class="list list-icons list-icons-sm d-inline-flex flex-column">
                    <li class="text-4 mb-2"><a href="/faq" class="link-hover-style-1 ml-1"> F.A.Q</a></li>
                    <li class="text-4 mb-2"><a href="/contact" class="link-hover-style-1 ml-1"> Контакты</a></li>
                    <li class="text-4 mb-2"><a href="/service" class="link-hover-style-1 ml-1"> Оплата и доставка</a>
                    </li>
                    <li class="text-4 mb-2"><a href="/support" class="link-hover-style-1 ml-1"> Поддержка клиентов</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container container-lg">
        <div class="footer-copyright footer-copyright-style-2">
            <div class="py-2">
                <div class="row py-4">
                    <div class="col d-flex align-items-center justify-content-center mb-4 mb-lg-0">
                        <p>Copyright 2019 © RUC.EXPERT - Реестр недобросовестных пользователей услугами
                            отелей/хостелами, проката автомашин/каршеринга, арендой помещений.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="defaultModalLabel">Выбать язык сайта</h5>
            </div>
            <div class="modal-body">
                <!-- GTranslate: https://gtranslate.io/ -->
                <a href="#" onclick="doGTranslate('ru|en');return false;" title="English" class="nturl btn btn-default"
                   style="font-size: 15px;background-position:-0px -0px;"><img src="/new_temp/news/img/lang/english.png"
                                                                               height="24" width="30" alt="English"
                                                                               style=" object-fit: fill;  padding: 2px;     margin-right: 4px;">
                    <p>English</p></a>
                <a href="#"
                   onclick="doGTranslate('ru|fr');return false;"
                   title="French"
                   class=" nturl btn btn-default"
                   style="font-size: 15px; background-position:-200px -100px;"><img
                            src="/new_temp/news/img/lang/french.png"
                            height="24" width="30" alt="French"
                            style=" object-fit: fill; padding: 2px;   margin-right: 4px;">
                    <p>French</p></a>
                <a href="#"
                   onclick="doGTranslate('ru|de');return false;"
                   title="German"
                   class=" nturl btn btn-default"
                   style="background-position:-300px -100px;"><img
                            style=" object-fit: fill; padding: 2px;   margin-right: 4px;"
                            src="/new_temp/news/img/lang/german.png" height="24" width="30" alt="German"/>
                    <p>German</p></a><a
                        href="#"
                        onclick="doGTranslate('ru|it');return false;"
                        title="Italian"
                        class="nturl btn btn-default"
                        style="font-size: 15px; background-position:-600px -100px;"><img
                            style=" object-fit: fill; padding: 2px;   margin-right: 4px;"
                            src="/new_temp/news/img/lang/russian.png" height="24" width="24" alt="Italian"/>
                    <p>Italian</p></a>
                <a href="#" onclick="doGTranslate('uz|uz');return false;" title="Uzbek" class=" nturl btn btn-default"
                   style="background-position:-300px -200px;"><img
                            style=" object-fit: fill; padding: 2px;   margin-right: 4px;"
                            src="/new_temp/news/img/lang/uz.png" height="24" width="30" alt="Uzbek"/>
                    <p>Uzbek</p></a><a
                        href="#" onclick="doGTranslate('ru|ru');return false;" title="Russian"
                        class=" nturl btn btn-default"
                        style="font-size: 15px; background-position:-500px -200px;"><img
                            style=" object-fit: fill; padding: 2px;   margin-right: 4px;"
                            src="/new_temp/news/img/lang/russian.png"
                            height="24" width="30" alt="Russian"/>
                    <p>Russian</p></a><a
                        href="#" onclick="doGTranslate('ru|es');return false;" title="Spanish"
                        class="btn btn-default nturl"
                        style="font-size: 15px; background-position:-600px -200px;"><img
                            style=" object-fit: fill; padding: 2px;   margin-right: 4px;"
                            src="/new_temp/news/img/lang/spanish.png"
                            height="24" width="30" alt="Spanish"/>
                    <p>Spanish</p></a>

                <style type="text/css">
                    <!--
                    a.gflag {
                        vertical-align: middle;
                        font-size: 24px;
                        padding: 1px 0;
                        background-repeat: no-repeat;
                        background-image: url(//gtranslate.net/flags/24.png);
                    }

                    a.gflag img {
                        border: 0;
                    }

                    a.gflag:hover {
                        background-image: url(//gtranslate.net/flags/24a.png);
                    }

                    #goog-gt-tt {
                        display: none !important;
                    }

                    .goog-te-banner-frame {
                        display: none !important;
                    }

                    .goog-te-menu-value:hover {
                        text-decoration: none !important;
                    }

                    body {
                        top: 0 !important;
                    }

                    #google_translate_element2 {
                        display: none !important;
                    }

                    -->
                </style>

                <div id="google_translate_element2"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit2() {
                        new google.translate.TranslateElement({
                            pageLanguage: 'ru',
                            autoDisplay: false
                        }, 'google_translate_element2');
                    }
                </script>
                <script type="text/javascript"
                        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>


                <script type="text/javascript">
                    /* <![CDATA[ */
                    eval(function (p, a, c, k, e, r) {
                        e = function (c) {
                            return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
                        };
                        if (!''.replace(/^/, String)) {
                            while (c--) r[e(c)] = k[c] || e(c);
                            k = [function (e) {
                                return r[e]
                            }];
                            e = function () {
                                return '\\w+'
                            };
                            c = 1
                        }
                        ;
                        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
                        return p
                    }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
                    /* ]]> */
                </script>
            </div>

        </div>
    </div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript"> (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })(window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js", "ym");
    ym(56893129, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true,
        trackHash: true
    }); </script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/56893129" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript> <!-- /Yandex.Metrika counter -->
<!--<script src="https://lidrekon.ru/slep/js/uhpv-full.min.js"></script>-->
</body>
</html>
<?php $this->endPage() ?>
