<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 04/01/16
 * Time: 21:34
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
backend\assets\InspiniaAsset::register($this);

$this->title = 'Админка';

?>

<section class="row flexbox-container" style="margin-top: 8%">
        <div class="col-xl-12 col-11 d-flex justify-content-center">
            <div class="card bg-authentication rounded-0 mb-0">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                        <img src="/admin/images/pages/login.png" alt="branding logo">
                    </div>
                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 px-2">
                            <div class="card-header pb-1">
                                <div class="card-title">
                                    <h4 class="mb-0">Вход</h4>
                                </div>
                            </div>
                            <p class="px-2">Добро пожаловать, пожалуйста, войдите в свой аккаунт.</p>
                            <div class="card-content">
                                <div class="card-body pt-1">
                                    <?php $form = \yii\widgets\ActiveForm::begin(['id' => 'login-form', 'class' => 'm-t']); ?>

                                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                                    <?= $form->field($model, 'password')->passwordInput() ?>

                                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                                    <div style="color:#999;margin:1em 0">
                                        Если вы забыли свой пароль, вы можете его  <?= Html::a('сбросить', ['site/request-password-reset']) ?>.
                                        <br>
                                        Требуется новое письмо с подтверждением?
                                         <?= Html::a('Отправить', ['site/resend-verification-email']) ?>
                                    </div>

                                    <div class="form-group">
                                        <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                                    </div>

                                    <?php \yii\widgets\ActiveForm::end(); ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

