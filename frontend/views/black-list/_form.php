<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BlackList */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">
    <div class="card-content ">
        <div class="card-body ">

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'type_org')->dropDownList($model->type_db) ?>
                </div>
            </div>
            <div class="row">
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
                    <?= $form->field($model, 'date_born')->textInput() ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'place_born')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <?=
                    $form->field($model, 'file[]')->widget(\kartik\file\FileInput::className(), [
                        'language' => 'ru',
                        'options' => ['multiple' => true],
                    ]) ?>
                </div>
            </div>


            <div class="form-group">
                <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
