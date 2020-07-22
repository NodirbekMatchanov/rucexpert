<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(); ?>

<div class="site-signup">

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-signup','action' => '/site/signup','options' => [ 'data-pjax' => true]]); ?>

            <?= $form->field($model, 'reg_hotel_type')->checkbox(['class' => 'reg_type', 'data-type' => 'hotel']) ?>
            <?= $form->field($model, 'reg_car_type')->checkbox(['class' => 'reg_type', 'data-type' => 'car']) ?>
            <?= $form->field($model, 'reg_rent_type')->checkbox(['class' => 'reg_type', 'data-type' => 'rent']) ?>
            <div class="registration-form <?= ($model->reg_hotel_type || $model->reg_car_type || $model->reg_rent_type) ? "" : "hidden" ?>">

                <?= $form->field($model, 'company')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['id' => 'phone']) ?>

                <?= $form->field($model, 'code')->textInput([]) ?>
                <a id="send-sms" class="btn btn-warning">Получить</a>


                <?= $form->field($model, 'email')->label('Email') ?>

               <div class="hotel-inputs <?= ($model->reg_hotel_type) ? "" : "hidden" ?>">
                   <?= $form->field($model, 'file')->fileInput() ?>

                   <?= $form->field($model, 'license_id') ?>

                   <?= $form->field($model, 'license_date') ?>
               </div>
                <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

                <?= $form->field($model, 'password_repeat')->passwordInput()->label('ПОВТОРИТЕ ПАРОЛЬ') ?>

                <?= $form->field($model, 'policy')->checkbox()
                    ->label(' <div style="color:#999;">ПРИНИМАЮ ' . Html::a('ПОЛИТИКУ КОНФИДЕНЦИАЛЬНОСТИ', ['#']) . '</div>') ?>

                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php Pjax::end(); ?>

