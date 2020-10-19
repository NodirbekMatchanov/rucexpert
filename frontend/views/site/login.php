<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
 $this->title = 'Войти';
?>
        <section class="body-sign new-form">
            <div class="center-sign">
                <div class="panel card-sign">
                    <a href="/" class="logo float-left">
                        <img src="/images/logo.png" height="60" alt="RucExpert">
                    </a>
                    <div class="card-title-sign mt-3 text-right">
                        <h2 class="title text-uppercase font-weight-bold m-0"><i class="fas fa-sign-in-alt mr-1" style="font-size: 20px;vertical-align: middle;"></i></h2>
                    </div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/site/login', 'options' => ['data-pjax' => true],]); ?>


                                <?= $form->field($model, 'username', [
                                    'template' => ' <label>Логин</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span></div>{error}',
                                ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>

                            <div class="form-group mb-3">
                                <div class="clearfix">
                                    <label class="float-left">Пароль</label>
                                    <a href="<?=\yii\helpers\Url::to(['site/request-password-reset'])?>" class="float-right">Забыли пароль?</a>
                                </div>
                                <?= $form->field($model, 'password', [
                                    'template' => ' <div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-lock"></i>
												</span>
											</span></div>{error}',
                                ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <?= Html::submitButton('Войти', ['class' => 'mb-1 mt-1 mr-1 btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                                </div>

                            </div>

                            <span class="mt-3 mb-3 line-thru text-center text-uppercase">
								<span>или</span>
							</span>

                            <div class="mb-1 text-center">
                                <a class="btn btn-facebook mb-3 ml-1 mr-1" style="color: white!important;" href="<?=\yii\helpers\Url::to('/site/auth?authclient=facebook')?>">Facebook</a>
                                <a class="btn btn-danger mb-3 ml-1 mr-1" style="color: white!important;"  href="<?=\yii\helpers\Url::to('/site/auth?authclient=google')?>">Google</a>
                            </div>

                            <p class="text-center">Нет учетной записи?<a href="<?=\yii\helpers\Url::to(['/site/signup'])?>"> Регистрация</a></p>

                        <?php ActiveForm::end(); ?>

                    </div>
                </div>

                <p class="text-center text-muted mt-3 mb-3">&copy; Copyright 2017. Все права защищены.</p>
            </div>
        </section>



