<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;

$this->title = 'Поиск';
?>
<div class="panel-heading">
    <h3>Личный кабинет</h3>
</div>
<section id="page-account-settings">

    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item ">
                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill"
                       href="#account-vertical-general" aria-expanded="true">
                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                        Настройки
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill"
                       href="#account-vertical-password" aria-expanded="false">
                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                        Сменить пароль
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-info" data-toggle="pill"
                       href="#account-vertical-info" aria-expanded="false">
                        <i class="feather icon-info mr-50 font-medium-3"></i>
                        Мои данные
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-social" data-toggle="pill"
                       href="#account-vertical-social" aria-expanded="false">
                        <i class="feather icon-camera mr-50 font-medium-3"></i>
                        Социальные ссылки
                    </a>
                </li>
            </ul>
        </div>
        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general"
                                 aria-labelledby="account-pill-general" aria-expanded="true">
                                <?php if (!empty($hotel)): ?>
                                    <?= $this->render('_form', ['model' => $hotel]) ?>
                                <?php endif; ?>
                            </div>
                            <div class="tab-pane fade " id="account-vertical-password" role="tabpanel"
                                 aria-labelledby="account-pill-password" aria-expanded="false">
                                <?= $this->render('_changePassword', ['model' => $changePassword]) ?>
                            </div>
                            <div class="tab-pane fade" id="account-vertical-info" role="tabpanel"
                                 aria-labelledby="account-pill-info" aria-expanded="false">
                                <div class="mt-2">
                                    <h6 class="mb-0">Login</h6>
                                    <p> <?= Yii::$app->user->identity->username ?></p>
                                </div>
                                <?php if (\backend\components\User::getRoleName() == 'director'): ?>
                                <div class="mt-2">
                                    <h6 class="mb-0">НАЗВАНИЕ ОРГАНИЗАЦИИ</h6>
                                    <p><?= $hotel->company ?></p>
                                </div>
                                <div class="mt-2">
                                    <h6 class="mb-0">ТЕЛЕФОН</h6>
                                    <p><?= $hotel->phone ?></p>
                                </div>
                                <div class="mt-2">
                                    <h6 class="mb-0">Счет</h6>
                                    <p><?= $hotel->balance ?> руб</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="tab-pane fade " id="account-vertical-social" role="tabpanel"
                                 aria-labelledby="account-pill-social" aria-expanded="false">
                                <div class="form-group text-center ">
                                    <h4 class="">Подключить соцсети</h4>
                                </div>
                                <div class="" style="display: flex; justify-content: center;">
                                    <?php echo yii\authclient\widgets\AuthChoice::widget([
                                        'baseAuthUrl' => ['personal-area/auth'],
                                        'popupMode' => false,
                                    ]) ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
