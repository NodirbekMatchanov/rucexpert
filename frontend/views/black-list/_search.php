<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'post',
    ]); ?>

    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'type_org')->dropDownList($model->type_db) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 hidden">
            <?= $form->field($model, 'searching')->textInput(['maxlength' => true,'class' => 'hidden','value' => true])->label(false) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'place_born')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
