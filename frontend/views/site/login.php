<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(); ?>
    <div class="panel-login container" <?= (Yii::$app->controller->action->id != 'index') ? 'style="margin-top: 100px"' : '' ?>>

        <p style="font-size: 16px">Добро пожаловать на сайт <b>Ruc.expert</b>
        </p>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'action' => '/site/login', 'options' => ['data-pjax' => true],]); ?>
        <div class="input-icons">
            <i class="fa fa-user icon">
            </i>
            <?= $form->field($model, 'username')->textInput(['class' => 'login-input form-control', 'placeholder' => 'Имя пользовтаеля'])->label(false) ?>
        </div>
        <div class="input-icons">
            <i class="fa fa-key icon">
            </i>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'login-input form-control', 'placeholder' => 'Пароль'])->label(false) ?>
        </div>
        <div class="login-form-buttons">
            <label class="checkcontainer"><span style="margin-top: 2px">Запоминить меня</span>
                <input id="hold_on" name="LoginForm[rememberMe]" style="display: none" type="checkbox">
                <span class="checkmark"></span>
            </label>

            <?= Html::a('Восстановить
            пароль', ['site/request-password-reset'], ['data-pjax' => false]) ?>.

        </div>
        <div class="login-form-buttons">
            <button type="button" data-toggle="modal" data-target="#signModal"
                    class="btn btn-signup">Регистрация
            </button>
            <?= Html::submitButton('Вход', ['class' => 'btn btn-login', 'name' => 'login-button']) ?>
        </div>
        <br>
        <p class="text-center  sign-social" style="font-size: 14px"><span
                    style="color: #000;">Войти через сеть</span>
        </p>
        <div class="story-container log">
            <div class="form-group" style="display: flex; align-items: center;     justify-content: center;">
                <?php echo yii\authclient\widgets\AuthChoice::widget([
                    'baseAuthUrl' => ['site/auth'],
                    'popupMode' => false,
                ]) ?>
            </div>
        </div>
        <div style="color:#999;margin:1em 0">

        </div>


        <?php ActiveForm::end(); ?>
    </div>
<?php Pjax::end(); ?>

<?php if(Yii::$app->controller->id == 'site' && Yii::$app->controller->action->id == 'login'):?>

    <?php
    \yii\bootstrap\Modal::begin([
        'header' => '<h4 class="modal-title">Регистрация</h4>',
        'size' => 'modal-lg',
        'options' => ['class' => 'modal fade', 'id' => 'signModal', 'aria-labelledby' => "signModalLabel"],
    ]);
    echo $this->render('signup', ['model' => $signModel]);

    \yii\bootstrap\Modal::end();
    ?>
<?php endif;?>
