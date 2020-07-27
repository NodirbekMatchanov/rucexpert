<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Главная страница';

?>

<div role="main" class="main" >

    <div class="slider-with-overlay">

        <div class="forcefullwidth_wrapper_tp_banner" id="revolutionSlider_forcefullwidth"
             style="position:relative;width:100%;height:auto;margin-top:0px;margin-bottom:0px">
            <div class="slider-container rev_slider_wrapper"
                 style="height: 670px; margin-top: 0px; margin-bottom: 0px; position: absolute; overflow: visible; width: 1349px; left: 0px;">
                <div id="revolutionSlider" class="slider rev_slider" data-version="5.4.8" data-plugin-revolution-slider
                     data-plugin-options="{'addOnTypewriter': { 'enable': true }, 'sliderLayout': 'fullscreen', 'delay': 9000, 'gridwidth': [1410,1110,930,690], 'gridheight': 700, 'disableProgressBar': 'on', 'responsiveLevels': [4096,1422,1182,974], 'navigation' : {'arrows': { 'enable': true, 'style': 'arrows-style-1 arrows-primary' }, 'bullets': {'enable': true, 'style': 'bullets-style-1', 'h_align': 'center', 'v_align': 'bottom', 'space': 7, 'v_offset': 70, 'h_offset': 0}}}">
                    <ul>
                        <li class="slide-overlay slide-overlay-level-8" data-transition="fade">
                            <img src="/new_temp/news/img/slides/slide-corporate-14-1.jpg"
                                 alt=""
                                 data-bgposition="center center"
                                 data-bgfit="cover"
                                 data-bgrepeat="no-repeat"
                                 class="rev-slidebg">

                            <h3 class="tp-caption font-weight-extra-bold text-color-light"
                                data-frames='[{"delay":1000,"speed":500,"frame":"0","from":"opacity:0;x:50%;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                                data-x="['left','left','left','center']"
                                data-y="center" data-voffset="['-100','-100','-100','-100']"
                                data-fontsize="['36','36','36','36']"
                                data-lineheight="['70','70','70','70']"
                                data-letterspacing="-1">Ruc Expert</h3>

                            <div class="tp-caption font-weight-extra-bold text-color-light"
                                 data-frames='[{"delay":500,"speed":2500,"from":"y:50px;sX:1;sY:1;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"to":"opacity:0;","ease":"nothing"}]'
                                 data-type="text"
                                 data-typewriter='{"lines":"аренды жилых<br>и нежилых помещений,правил%20пользования%20<br>сервисом%20каршеринга<br>и аренды авто,правил%20проживания<br>в отелях и хостелах","enabled":"on","speed":"60","delays":"1%7C100","looped":"on","cursorType":"one","blinking":"on","word_delay":"off","sequenced":"on","hide_cursor":"off","start_delay":"1500","newline_delay":"1000","deletion_speed":"20","deletion_delay":"1000","blinking_speed":"500","linebreak_delay":"60","cursor_type":"two","background":"off"}'
                                 data-x="['left','left','left','center']"
                                 data-y="center" data-voffset="['-33','-33','-33','-33']"
                                 data-responsive_offset="on"
                                 data-width="['750','750','750','750']"
                                 data-fontsize="['36','36','36','36']"
                                 data-lineheight="['50','50','50','50']"
                                 data-textAlign="['left','left','left','center']">Международный реестр <br>нарушителей
                            </div>


                            <a class="tp-caption btn btn-primary font-weight-bold rounded"
                               href="#" data-toggle="modal" data-target="#largesizemodal"
                               data-frames='[{"delay":3000,"speed":2000,"frame":"0","from":"y:50%;opacity:0;","to":"y:0;o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;fb:0;","ease":"Power3.easeInOut"}]'
                               data-x="['left','left','left','center']"
                               data-y="center" data-voffset="['103','103','103','140']"
                               data-paddingtop="['16','16','16','24']"
                               data-paddingbottom="['16','16','16','24']"
                               data-paddingleft="['40','40','40','45']"
                               data-paddingright="['40','40','40','45']"
                               data-fontsize="['14','14','14','18']"
                               data-lineheight="['20','20','20','22']"> <i
                                        class="fas fa-lock-right ml-1">РЕГИСТРАЦИЯ</i></a>

                        </li>
                    </ul>
                </div>
            </div>
            <div class="tp-fullwidth-forcer" style="width: 100%; height: 670px;"></div>
        </div>

        <div class="slider-contact-form">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6" >
                        <div class="featured-box featured-box-primary text-left mt-5">
                            <div class="slider-contact-form-wrapper box-content  bg-primary rounded p-5 appear-animation animated fadeInLeftShorter appear-animation-visible"
                                 data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="2000"
                                 style="animation-delay: 2000ms; margin: 1rem!important;">
                                <div class="row" >
                                    <?php if (!empty($newsList)): ?>
                                        <?php $i = 0; foreach ($newsList as $k => $news): ?>
                                            <?php  foreach ($news as $item) : $i++?>
                                            <?if($i <= 4):?>
                                               <div class="col-6">
                                                   <a href="<?= Url::to(['news/view', 'id' => $item['id']]) ?>">
                                                   <?= Html::img('/uploads/news/' . $item['img'], ['class' => 'img img-thumbnail','style' => 'width: 200px; height: 120px; object-fit:cover']) ?>
                                                   <p><?= \yii\helpers\StringHelper::truncate($item['title'],40)  ?></p></a>
                                               </div>
                                            <?php endif;?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="container">

        <div id="o-proekte" class="row text-center pt-3">
            <div class="col-md-10 mx-md-auto">
                <h1 class="word-rotator slide font-weight-bold text-8 mb-3 appear-animation animated fadeInUpShorter appear-animation-visible"
                    data-appear-animation="fadeInUpShorter" style="animation-delay: 100ms;">
                    <span>Международный реестр нарушителей правил пользования услуг </span>
                    <span class="word-rotator-words bg-dark">
									<b class="is-hidden">ОТЕЛЕЙ</b>
									<b class="is-visible">КАРШЕРИНГА</b>
									<b class="is-visible">АРЕНДЫ</b>
								</span>

                </h1>
                <h3 style="color: green;font-weight: bold;">
                    <center>База реестра: <?= $count ?></center>
                </h3>

                <p class="lead appear-animation animated fadeInUpShorter appear-animation-visible"
                   data-appear-animation="fadeInUpShorter" data-appear-animation-delay="300"
                   style="animation-delay: 300ms;">
                    Въехать в отель, снять апартаменты, одолжить машину в каршеринге сейчас проще простого: достаточно
                    скачать приложение и иметь под рукой кредитку. Недобросовестные граждане пользуются этой
                    доступностью, нанося вред имуществу и репутации компании. <br>Решение проблемы – прямо перед вами:
                    <br><b>RUC EXPERT</b> – реестр безответственных постояльцев и арендаторов.
                </p>
            </div>
        </div>

    </div>
    <div class="container container-lg py-5 my-2">
        <div class="row text-center text-md-left">
            <div class="col-lg-4 mt-5 appear-animation animated fadeInLeftShorter appear-animation-visible"
                 data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="600"
                 style="animation-delay: 600ms;">
                <p class="text-7 gradient-text-color font-weight-bold line-height-5 negative-ls-2">RUC.EXPERT - Онлайн
                    сервис, который всегда доступен 24 / 7 / 365 на любом усройстве.</p>
            </div>
            <div class="col-lg-8">
                <div class="row featured-boxes featured-boxes-style-4">
                    <div class="col-md-6">
                        <div class="featured-box featured-box-primary featured-box-effect-4 appear-animation animated fadeInLeftShorter appear-animation-visible"
                             data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400"
                             style="height: 191px; animation-delay: 400ms;">
                            <div class="box-content px-4">
                                <i class="icon-featured icon-screen-tablet icons text-14 mb-4 w-75"></i>
                                <h4 class="font-weight-bold text-color-dark pb-1 mb-2">Мобильная версия</h4>
                                <p class="px-3 mb-0">Наш сайт адаптирован под все мобильные устройства. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="featured-box featured-box-primary featured-box-effect-4 appear-animation animated fadeInLeftShorter appear-animation-visible"
                             data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="200"
                             style="height: 191px; animation-delay: 200ms;">
                            <div class="box-content px-4">
                                <i class="icon-featured icon-layers icons text-14 mb-4 w-75"></i>
                                <h4 class="font-weight-bold text-color-dark pb-1 mb-2">Наш веб - сайт</h4>
                                <p class="px-3 mb-0">Сайт RUC.EXPERT постоянно доступен в любой момент, когда Вам
                                    понадобится.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="call-to-action call-to-action-default with-button-arrow call-to-action-in-footer"
             style="background: #0097e5;">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-lg-9">
                    <div class="call-to-action-content">
                        <h3 style="color: white;">У нас всегда актуальная база нарушителей. <br><strong
                                    class="font-weight-extra-bold"> Пополняется ежедневно</strong></h3>

                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="call-to-action-btn">
                        <a href="#" data-toggle="modal" data-target="#signModal"
                           class="btn btn-modern text-2 btn-light">ЗАРЕГИСТРИРОВАТЬСЯ</a><span
                                class="arrow hlb d-none d-md-block appear-animation animated rotateInUpLeft appear-animation-visible"
                                data-appear-animation="rotateInUpLeft"
                                style="left: 110%; top: -40px; animation-delay: 100ms;"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-default border-0 mt-5 appear-animation animated fadeIn appear-animation-visible"
             data-appear-animation="fadeIn" data-appear-animation-delay="1200" style="animation-delay: 1200ms;">
        <div class="container py-4">

            <div class="row justify-content-center">
                <div class="col-xl-9 text-center">
                    <h2 class="font-weight-bold text-11 appear-animation" data-appear-animation="fadeInUpShorter">Мы
                        поможем Вам сберечь</h2>
                    <!--<p class="line-height-9 text-4 opacity-9 appear-animation" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras volutpat id sapien ac varius. Fusce hendrerit ligula a consectetur ullamcorper. Vestibulum varius pharetra lorem, in maximus libero placerat sed. In a lectus vel mauris tempor lobortis feugiat sed magna.</p>-->
                </div>
            </div>
            <div class="row featured-boxes featured-boxes-style-4">
                <div class="col-sm-6 col-lg-3 appear-animation" data-appear-animation="fadeInLeftShorter"
                     data-appear-animation-delay="400">
                    <div class="featured-box mb-lg-0">
                        <div class="box-content px-lg-1 px-xl-5">
                            <i class="icon-featured icons icon-star text-color-primary text-11"></i>
                            <h4 class="font-weight-bold text-5 mb-3">Репутацию</h4>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 appear-animation" data-appear-animation="fadeInLeftShorter"
                     data-appear-animation-delay="200">
                    <div class="featured-box mb-lg-0">
                        <div class="box-content px-lg-1 px-xl-5">
                            <i class="icon-featured icons icon-lock text-color-primary text-11"></i>
                            <h4 class="font-weight-bold text-5 mb-3">Безопасность клиентов</h4>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 appear-animation" data-appear-animation="fadeInRightShorter"
                     data-appear-animation-delay="200">
                    <div class="featured-box mb-sm-0">
                        <div class="box-content px-lg-1 px-xl-5">
                            <i class="icon-featured icons icon-wallet text-color-primary text-11"></i>
                            <h4 class="font-weight-bold text-5 mb-3">Деньги</h4>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 appear-animation" data-appear-animation="fadeInRightShorter"
                     data-appear-animation-delay="400">
                    <div class="featured-box mb-0">
                        <div class="box-content px-lg-1 px-xl-5">
                            <i class="icon-featured icons icon-user-following text-color-primary text-11"></i>
                            <h4 class="font-weight-bold text-5 mb-3">Ваш покой</h4>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pt-5">

            <div class="row py-4 mb-2">
                <div class="col-md-7 order-2">
                    <div class="overflow-hidden">
                        <h2 class="text-color-dark font-weight-bold text-12 mb-0 pt-0 mt-0 appear-animation"
                            data-appear-animation="maskUp" data-appear-animation-delay="300">Задайте Ваш вопрос
                            экспертам</h2>
                    </div>
                    <div class="overflow-hidden mb-3">
                        <p class="font-weight-bold text-primary text-uppercase mb-0 appear-animation"
                           data-appear-animation="maskUp" data-appear-animation-delay="500">ruc.expert</p>
                    </div>
                    <p class="lead appear-animation" data-appear-animation="fadeInUpShorter"
                       data-appear-animation-delay="700">У каждого из нас в жизни случаются моменты, когда неоходима
                        грамотная консультация эксперта по тому или иному вопросу в такой узкоспециализированной
                        области, как аренда помещений жилых и нежилых, каршеринг и прибывание в отеле.</p>
                    <p class="pb-3 appear-animation" data-appear-animation="fadeInUpShorter"
                       data-appear-animation-delay="800">В среднем ответ составляет от 3 до 7 рабочих дней.</p>
                    <hr class="solid my-4 appear-animation" data-appear-animation="fadeInUpShorter"
                        data-appear-animation-delay="900">
                    <div class="row align-items-center appear-animation" data-appear-animation="fadeInUpShorter"
                         data-appear-animation-delay="1000">
                        <div class="col-lg-12">
                            <a href="#" data-toggle="modal" data-target="#signModal"
                               class="btn btn-modern mt-3 btn-danger">ЗАРЕГИСТРИРОВАТЬСЯ</a>
                            <a href="#" data-toggle="modal" data-target="#feedBackModal"
                               class="btn btn-modern btn-primary mt-3">Получить консультацию</a>
                        </div>

                    </div>
                </div>
                <div class="col-md-5 order-md-2 mb-4 mb-lg-0 appear-animation"
                     data-appear-animation="fadeInRightShorter">
                    <img src="new_temp/img/man.png" class="img-fluid mb-2" alt="" style="height: 400px;">
                </div>
            </div>
        </div>
    </section>


    <section class="section section-height-3 section-parallax bg-color-light border-0 m-0" data-plugin-parallax
             data-plugin-options="{'speed': 1.5, 'parallaxHeight': '100%', 'offset': 70}"
             data-image-src="img/parallax/parallax-corporate-14-2.jpg">
        <div class="container container-lg">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-5 col-xl-6 text-center pr-5 mb-5 mb-md-0 appear-animation"
                     data-appear-animation="fadeInLeftShorter" data-appear-animation-delay="400">
                    <img src="/new_temp/news/img/smartphone-corporate-14-2.png" class="img-fluid" alt=""/>
                </div>
                <div class="col-md-6 col-lg-7 col-xl-6 appear-animation" data-appear-animation="fadeInLeftShorter"
                     data-appear-animation-delay="200">
                    RUC.EXPERT – международная база. Постоялец, грубо нарушивший правила в отеле в Белоруссии, получит
                    отказ в заселении в России. В Австрии. В Греции. Где угодно. Безнаказанность – в прошлом.
                    Столкнулись с неадекватным поведением клиента? Регистрируйтесь на нашем сайте и вносите его в
                    реестр. Обязательно нужно указать фамилию, имя, место рождения и кратко описать инцидент, будь то
                    вождение в пьяном виде, кража ковриков из салона, агрессивное общение с персоналом, шум по ночам.
                    «Пробить» нового клиента тоже легко: потребуется лишь ввести фамилию и уточняющие сведения (e-mail,
                    телефон). Важный момент: мы соблюдаем законы о защите личных (в частности, паспортных) данных,
                    принятые в разных странах. Стоп-лист не выводится целиком – только подходящие запросы.
                    RUC.EXPERT – доступный в освоении инструмент для владельца отельного бизнеса, службы каршеринга,
                    арендодателя. Реестр решает сразу две задачи – наказать недобросовестных арендаторов и оградиться от
                    них в дальнейшем. Работа нашей базы в перспективе усилит ответственность гостей, исключит
                    нежелательных клиентов и упростит жизнь законопослушным гражданам и бизнесу.

                </div>

            </div>
        </div>

    </section>

    <section class="call-to-action call-to-action-default with-button-arrow call-to-action-in-footer"
             style="background: #0097e5;">
        <div class="container">
            <h3 class="text-center" style="color: white">Быстрая регистрация</h3>
            <div class="row" style="display: flex; align-items: center; justify-content: center">
                <?= Html::textInput('email', '', ['class' => 'form-control fast-sign-email', 'placeholder' => 'email']) ?>
                <div class="input-group" style="width: 36%">
                    <?= Html::textInput('phone', '', ['class' => 'form-control fast-sign-phone', 'placeholder' => 'телефон']) ?>
                    <div class="input-group-append">
                        <button style=" width: 150px;
                      border-bottom-left-radius: 0px!important;
                      border-top-left-radius: 0px!important;
                      border-top-right-radius: 5px!important;
                      border-bottom-right-radius: 5px!important;
                      background: #267df4;
                      color: white;
                        " class="btn btn-outline-secondary fast-sign-reg" type="button">РЕГИСТРАЦИЯ
                        </button>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-9 col-lg-9">

                    <div class="call-to-action-content">
                        <h3 style="color: white;">У нас всегда актуальная база нарушителей. <br><strong
                                    class="font-weight-extra-bold"> Пополняется ежедневно</strong></h3>


                    </div>
                </div>
                <div class="col-sm-3 col-lg-3">
                    <div class="call-to-action-btn">
                        <a href="#" data-toggle="modal" data-target="#signModal"
                           class="btn btn-modern text-2 btn-light">ЗАРЕГИСТРИРОВАТЬСЯ</a><span
                                class="arrow hlb d-none d-md-block appear-animation animated rotateInUpLeft appear-animation-visible"
                                data-appear-animation="rotateInUpLeft"
                                style="left: 110%; top: -40px; animation-delay: 100ms;"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>




<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4 class="modal-title">Подтвердите код</h4>',
    'toggleButton' => ['label' => 'click me', 'id' => 'openModal', 'class' => 'hidden'],
]);
\yii\bootstrap\Modal::end();
?>


<!-- Login -->

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4 class="modal-title">Авторизация</h4>',
    'options' => ['class' => 'modal fade', 'id' => 'loginModal', 'aria-labelledby' => "loginModalLabel"],
]);
echo $this->render('login', ['model' => $model]);

\yii\bootstrap\Modal::end();
?>

<!--Login END-->

<!-- Sign up -->

<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4 class="modal-title">Регистрация</h4>',
    'size' => 'modal-lg',
    'options' => ['class' => 'modal fade', 'id' => 'signModal', 'aria-labelledby' => "signModalLabel"],
]);
echo $this->render('signup', ['model' => $signModel]);

\yii\bootstrap\Modal::end();
?>

<!--Contact start-->
<?php
\yii\bootstrap\Modal::begin([
    'header' => '<h4 class="modal-title">Получить консультацию</h4>',
    'size' => 'modal-lg',
    'options' => ['class' => 'modal fade', 'id' => 'feedBackModal', 'aria-labelledby' => "feedBackModalLabel"],
]);
echo $this->render('contact', ['model' => $contact]);

\yii\bootstrap\Modal::end();
?>
<!--Contact END-->