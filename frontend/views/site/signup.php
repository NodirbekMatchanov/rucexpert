<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
$this->title = 'Регистрация';

?>

<section class="body-sign new-form">
    <div class="center-sign">
        <div class="panel card-sign">
            <a href="/" class="logo float-left">
                <img src="/images/logo.png" height="60" alt="RucExpert" />
            </a>
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0">
                    <i class="fas fa-lock mr-1" style="font-size: 20px;vertical-align: middle;"></i>
            </div>
            <?php yii\widgets\Pjax::begin(['id' => 'new_note']) ?>

            <section class="card form-wizard" id="w5">
                <div class="card-body">
                    <div class="wizard-tabs" style="visibility: hidden; position: absolute;">
                        <ul class="nav wizard-steps">
                            <li class="nav-item active">
                                <a class="nav-link" href="#w5-account" data-toggle="tab"><span class="badge">1</span>Account Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#w5-profile" data-toggle="tab"><span class="badge">2</span>Profile Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#w5-billing" data-toggle="tab"><span class="badge">3</span>Billing Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#w5-confirm" data-toggle="tab"><span class="badge">4</span>Confirmation</a>
                            </li>
                        </ul>
                    </div>
                    <div class="progress progress-striped progress-xl m-md light">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                            <span class="sr-only">60%</span>
                        </div>
                    </div>
                        <?php $form = ActiveForm::begin(['id' => 'form-signup','action' => '/site/signup'],['options' => ['data-pjax' => true]]); ?>

                        <div class="tab-content">
                            <div class="help-block step1_error"></div>
                            <div id="w5-account" class="tab-pane active" >
                                <div class="checkbox-custom">
                                    <input type="checkbox" name="SignupForm[reg_hotel_type]" id="w5-car" >
                                    <label for="w5-car">ОТЕЛИ / ХОСТЕЛЫ</label>
                                    <div class="help-block"></div>
                                </div>
                                <div class="checkbox-custom">
                                    <input type="checkbox" name="SignupForm[reg_car_type]" id="w5-car">
                                    <label for="w5-car">Каршеринг / Прокат автомобилей</label>
                                    <div class="help-block"></div>
                                </div>
                                <div class="checkbox-custom">
                                    <input type="checkbox" name="SignupForm[reg_rent_type]" id="w5-rent">
                                    <label for="w5-rent">Аренда помещений</label>
                                    <div class="help-block"></div>
                                </div>

                            </div>
                            <div id="w5-profile" class="tab-pane">
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'company', [
                                        'template' => ' <label>Название организации</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-user-circle"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                </div>
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'email', [
                                        'template' => ' <label>E-mail</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-envelope-open"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                </div>
                            </div>
                            <div id="w5-billing" class="tab-pane">
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'license_id', [
                                        'template' => ' <label>Номер лицензии (при наличии)</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-file"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                </div>
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'license_date', [
                                        'template' => ' <label>Дата выдачи (при наличии)</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-calendar-alt"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Загрузить лицензию (при наличии)</label>
                                    <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                                        <div class="input-append">
                                            <div class="uneditable-input">
                                                <i class="fas fa-file fileupload-exists"></i>
                                                <span class="fileupload-preview"></span>
                                            </div>
                                            <span class="btn btn-default btn-file" style="background: #e9ecef;">
																<span class="fileupload-exists"><i class="far fa-edit"></i></span>
																<span class="fileupload-new"><i class="far fa-file"></i></span>
																<input type="file">
															</span>
                                            <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload" style="background: #e9ecef;"><span><i class="far fa-trash-alt"></i></span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="w5-confirm" class="tab-pane">
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'phone', [
                                        'template' => ' <label>Номер телефона</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-phone"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                </div>
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'code', [
                                        'template' => ' <label>Код подтверждения</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-keyboard"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                    <a id="send-sms" style="color: white!important;" class="btn btn-warning">Получить</a>
                                </div>
                                <div class="form-group mb-3">
                                    <?= $form->field($model, 'password', [
                                        'template' => ' <label>Пароль</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-key"></i>
												</span>
											</span></div>{error}',
                                    ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="checkbox-custom form-group field-signupform-policy required ">
                                        <input type="checkbox" name="SignupForm[policy]" id="w5-policy" >
                                        <label for="w5-policy">Принимаю политику конфиденциальности </label>
                                        <div class="help-block"></div>
                                    </div>
                                    <div class="checkbox-custom field-signupform-policy_user">
                                        <input type="checkbox" name="SignupForm[policy_user]" id="w5-rules" >
                                        <label for="w5-rules">Принимаю правила пользования сервисом </label>
                                        <div class="help-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <ul class="pager">
                        <li class="previous disabled">
                            <a><i class="fas fa-angle-left"></i> Назад</a>
                        </li>
                        <li class="finish hidden float-right">
                            <button id="sub" type="submit" class="finish-button">Регистрация</button>
                        </li>
                        <li class="next">
                            <a>Далее <i class="fas fa-angle-right"></i></a>
                        </li>
                    </ul>
                </div>
            </section>
            <?php ActiveForm::end(); ?>
            <?php Pjax::end(); ?>
            <p class="text-center">Уже есть учетная запись? <a href="<?=\yii\helpers\Url::to(['/site/login'])?>">Войти</a></p>
            <p class="text-center text-muted mt-3 mb-3">&copy; Copyright <?=date("Y")?>. Все права защищены.</p>
        </div>
</section>



