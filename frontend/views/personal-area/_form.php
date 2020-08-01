<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="media">

    <div class="media-body mt-75">
        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
            <!--            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light avatar-upload"-->
            <!--                   for="account-upload">Загрузить фото</label>-->
            <input class="profile-image-input" type="file" name="Hotels[file]" id="account-upload" hidden="">
        </div>
        <!--        <p class="text-muted ml-75 mt-50">-->
        <!--            <small>Допускается JPG, GIF или PNG. Максимум размер 800KB</small>-->
        <!--        </p>-->

    </div>
</div>
<div class="registration-form ">

    <?= $form->field($model, 'company')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['id' => 'phone']) ?>

    <?= $form->field($model, 'license_id') ?>

    <?= $form->field($model, 'license_date') ?>

    <div class="row">
        <div class="col-4">
            <?= $form->field($model, 'reg_hotel_type', ['template' => ' <div class="switch switch-sm switch-primary">{input}{error}{hint}</div>'])->checkbox(['class' => 'reg_type', 'data-type' => 'hotel', 'data-plugin-ios-switch' => ''])->label(false) ?>
        </div>

        <div class="col-4">
            <?= $form->field($model, 'reg_car_type', ['template' => ' <div class="switch switch-sm switch-success">{input}{error}{hint}</div>'])->checkbox(['class' => 'reg_type', 'data-type' => 'car', 'data-plugin-ios-switch' => ''])->label(false) ?>
        </div>
        <div class="col-4">
            <?= $form->field($model, 'reg_rent_type', ['template' => '<div class="switch switch-sm switch-danger">{input}{error}{hint}</div>'])->checkbox(['class' => 'reg_type', 'data-type' => 'rent', 'data-plugin-ios-switch' => ''])->label(false) ?>
        </div>


    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
