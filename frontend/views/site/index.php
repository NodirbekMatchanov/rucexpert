<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Главная страница';

?>
<div class="site-index">
    <p class="text-center">
        <img src="/images/desc.png" width="50%">
    </p>
    <div class="text-justify">
        <h3>База реестра: <?= $count ?></h3>
        <p>
            Въехать в отель, снять апартаменты, одолжить машину в каршеринге сейчас проще простого: достаточно скачать
            приложение и иметь под рукой кредитку. Недобросовестные граждане пользуются этой доступностью, портя
            имущество и нанося вред репутации компании. Решение проблемы – прямо перед вами: RUC EXPERT – реестр
            безответственных постояльцев и арендаторов.
            Подобные «черные списки» ведут гостиничные сети в США и Европе. Наш онлайн-сервис не ограничен одним
            регионом/государством. RUC EXPERT – международная база. Постоялец, грубо нарушивший правила в отеле в
            Белоруссии, получит отказ в заселении в России. В Австрии. В Греции. Где угодно. Безнаказанность – в
            прошлом.
            Столкнулись с неадекватным поведением клиента? Регистрируйтесь на нашем сайте и вносите его в реестр.
            Обязательно нужно указать фамилию, имя, место рождения и кратко описать инцидент, будь то вождение в пьяном
            виде, кража ковриков из салона, агрессивное общение с персоналом, шум по ночам. «Пробить» нового клиента
            тоже легко: потребуется лишь ввести фамилию и уточняющие сведения (e-mail, телефон). Важный момент: мы
            соблюдаем законы о защите личных (в частности, паспортных) данных, принятые в разных странах. Стоп-лист не
            выводится целиком – только подходящие запросы.
            RUC EXPERT – доступный в освоении инструмент для владельца отельного бизнеса, службы каршеринга,
            арендодателя. Реестр решает сразу две задачи – наказать недобросовестных арендаторов и оградиться от них в
            дальнейшем. Работа нашей базы в перспективе усилит ответственность гостей, исключит нежелательных клиентов и
            упростит жизнь законопослушным гражданам и бизнесу. Подключайтесь!
        </p>
    </div>
    <div class="row" style="display: flex; align-items: center; justify-content: space-around">
        <?= Html::textInput('email', '', ['class' => 'form-control fast-sign-email', 'placeholder' => 'email']) ?>
        <?= Html::textInput('phone', '', ['class' => 'form-control', 'placeholder' => 'phone']) ?>
        <?= Html::button('Регистрация', ['class' => 'btn btn-success fast-sign-reg']) ?>
    </div>
    <div class="row">
        <?= \yii\helpers\Html::a('Все новости', Url::to(['news/index']), ['class' => 'btn btn-warning']) ?>
    </div>
    <div class="row">
        <br>
        <?php if (!empty($news)):
            foreach ($news as $item):
                ?>
                <div class="col-md-4 col-lg-4 col-sm-6 col-xs-12">
                    <div class="" style="height: 200px">
                       <a href="<?=Url::to(['news/view', 'id' => $item->id])?>">
                        <?php if ($item->img != ''): ?>
                            <?= Html::img('/uploads/news/' . $item->img, ['class' => 'home-img']) ?>
                        <?php else: ?>
                            <?= Html::img("/images/notfound.png", ['class' => 'home-img']) ?>
                        <?php endif; ?>
                       </a>
                    </div>
                    <h5>
                        <?= Html::a($item->title, Url::to(['news/view', 'id' => $item->id]), ['class' => '']) ?>
                    </h5>
                </div>
            <?php
            endforeach;
        endif;
        ?>
    </div>
</div>

<?php
\yii\bootstrap\Modal::begin([
    'header' => 'Подтвердите код',
    'toggleButton' => ['label' => 'click me', 'id' => 'openModal', 'class' => 'hidden'],
]);


\yii\bootstrap\Modal::end();
?>
