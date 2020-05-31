<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="media">
    <a href="">
        <?php
        $img = '/web/images/avatar-default-icon.png';
        if(!empty($model->avatar)){
            $img = '/uploads/files/'.$model->avatar;
        }
        ?>
        <img src="<?=$img?>" class="rounded mr-75 avatar" style="object-fit: cover" alt="profile image"
             height="64" width="64">
    </a>
    <div class="media-body mt-75">
        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light avatar-upload"
                   for="account-upload">Загрузить фото</label>
            <input type="file" name="Hotels[file]" id="account-upload" hidden="">
        </div>
        <p class="text-muted ml-75 mt-50">
            <small>Допускается JPG, GIF или PNG. Максимум размер 800KB</small>
        </p>

    </div>
</div>
<?= $form->field($model, 'reg_hotel_type')->checkbox(['class' => 'reg_type', 'data-type' => 'hotel']) ?>
<?= $form->field($model, 'reg_car_type')->checkbox(['class' => 'reg_type', 'data-type' => 'car']) ?>
<?= $form->field($model, 'reg_rent_type')->checkbox(['class' => 'reg_type', 'data-type' => 'rent']) ?>
<div class="registration-form ">

    <?= $form->field($model, 'company')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['id' => 'phone']) ?>

    <?= $form->field($model, 'license_id') ?>

    <?= $form->field($model, 'license_date') ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
