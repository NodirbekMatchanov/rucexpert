<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use \yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Профиль';
$role = \backend\components\User::getRoleName();
?>
<?php $this->beginBlock('sidebar'); ?>
<h2><?= $this->title ?></h2>
<?php $this->endBlock(); ?>

<div class="card">
    <div class="card-body card-dashboard">
        <section id="dashboard-analytics" class="dashboard-analytics">


            <?php if (Yii::$app->request->get('new-user')): ?>

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class=" bg-analytics text-white">
                        <div class="card-content">
                            <div class="card-body text-center">
                                <img src="/admin/images/elements/decore-left.png" class="img-left" alt="
            card-img-left">
                                <img src="/admin/images/elements/decore-right.png" class="img-right" alt="
            card-img-right">
                                <div class="avatar avatar-xl bg-primary shadow mt-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-award white font-large-1"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <h1 class="mb-2 text-white"><?= Yii::$app->user->identity->username ?></h1>
                                    <p class="m-auto w-75">Поздравляем вам доступно 5 бесплатных бонусов для поиска</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        </section>

        <section id="page-account-settings">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex justify-content-center ">

                        <div class="profile-image-outer-container">
                            <div class="profile-image-inner-container bg-color-primary">
                                <?php
                                $img = '/images/avatar-default-icon.png';
                                if (!empty($hotel->avatar)) {
                                    $img = '/uploads/files/' . $hotel->avatar;
                                }
                                ?>
                                <img class="avatar" style="object-fit: cover" src="<?= $img ?>">
                                <span class="profile-image-button bg-color-dark">
											<i class="fas fa-camera text-light"></i>
										</span>
                            </div>
                            <!--                            <input type="file" name="avatar" id="account-upload" class="profile-image-input">-->
                        </div>
                    </div>
                    <!-- left menu section -->
                    <aside class=" tabs-right tabs-navigation tabs-navigation-simple" style="padding: 0px 54px">
                        <ul class="nav nav-list flex-column mb-5">
                            <li class="nav-item active">
                                <a class="nav-link text-dark active" href="#tabsNavigationVertSimple1"
                                   data-toggle="tab">Данные
                                    профиля</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabsNavigationVertSimple2" data-toggle="tab">Сменить
                                    пароль</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabsNavigationVertSimple3" data-toggle="tab">Платежный
                                    баланс</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#tabsNavigationVertSimple4" data-toggle="tab">Связать с
                                    аккаунтами</a>
                            </li>

                        </ul>
                    </aside>
                </div>
                <div class="col-lg-8">
                    <div class="tab-pane tab-pane-navigation active" id="tabsNavigationVertSimple1">
                        <?php if (!empty($hotel)): ?>
                            <?= $this->render('_form', ['model' => $hotel]) ?>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane tab-pane-navigation" id="tabsNavigationVertSimple2">
                        <?= $this->render('_changePassword', ['model' => $changePassword]) ?>
                    </div>
                    <div class="tab-pane tab-pane-navigation" id="tabsNavigationVertSimple3">
                        <div class="form-group text-center ">
                            <h4 class="">Пополнить баланс</h4>
                        </div>
                        <div class="mt-2">
                            <h6 class="mb-0">Счет</h6>
                            <p><?= $hotel->balance ?> руб</p>
                        </div>
                        <?php if ($role == 'director'): ?>
                            <?php $form = ActiveForm::begin(['action' => '/payment/invoice']); ?>
                            <?= $form->field($invoice, 'summ')->textInput(['autofocus' => true, 'value' => 100]) ?>
                            <?= Html::submitButton('Оплатить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            <?php ActiveForm::end(); ?>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane tab-pane-navigation" id="tabsNavigationVertSimple4">
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

        </section>
    </div>
</div>
