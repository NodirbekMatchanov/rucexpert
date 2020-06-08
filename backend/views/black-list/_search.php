<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BlackListSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="black-list-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'middle_name') ?>

    <?= $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'date_born') ?>

    <?php // echo $form->field($model, 'place_born') ?>

    <?php // echo $form->field($model, 'moder') ?>

    <?php // echo $form->field($model, 'moder_comment') ?>

    <?php // echo $form->field($model, 'ser_num_car') ?>

    <?php // echo $form->field($model, 'type_org') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
