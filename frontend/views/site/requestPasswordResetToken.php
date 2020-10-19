<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Запросить сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="body-sign new-form">
    <div class="center-sign">
        <div class="panel card-sign">
            <a href="/" class="logo float-left">
                <img src="/images/logo.png" height="60" alt="RucExpert">
            </a>
            <div class="card-title-sign mt-3 text-right">
                <h2 class="title text-uppercase font-weight-bold m-0">
                    <i class="fas fa-key mr-1" style="font-size: 20px;vertical-align: middle;"></i>
                </h2></div>

            <div class="card-body">
                <div class="alert alert-info">
                    <p class="m-0">Введите свой e-mail адрес и следуйте дальнейшим инструкциям.</p>
                </div>

                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <div class="form-group mb-0">
                        <div class="form-group mb-3">
                            <?= $form->field($model, 'email', [
                                'template' => ' <label>E-mail</label><div class="input-group" style="margin-bottom: 1rem !important;">{input}<span class="input-group-append">
												<span class="input-group-text">
													<i class="fas fa-envelope-open"></i>
												</span>
											</span></div>{error}',
                            ])->textInput(['maxlength' => true, 'placeholder' => ''])->label(false) ?>
                        </div>
                    <div class="form-group">
                        <?= Html::submitButton('Восстановить пароль', ['class' => 'mb-1 mt-1 mr-1 btn btn-primary btn-lg btn-block']) ?>
                    </div>
                    </div>

                    <p class="text-center mt-3">Вспомнили? <a href="<?=\yii\helpers\Url::to(['site/login'])?>">Войти</a></p>
                <?php ActiveForm::end(); ?>

            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">© Copyright 2017. Все права защищены.</p>
    </div>
</section>
