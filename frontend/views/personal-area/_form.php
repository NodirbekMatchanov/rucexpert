<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Hotels */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

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
