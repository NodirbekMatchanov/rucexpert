<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BlackList */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="card">
    <div class="card-body card-dashboard">

        <div class="black-list-index">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'type_org')->dropDownList($model->type_db) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 hidden">
                    <?= $form->field($model, 'searching')->textInput(['maxlength' => true, 'class' => 'hidden', 'value' => true])->label(false) ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'last_name', [
                        'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span>{input}</div>',
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Иванов'])->label('Фамилия') ?>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'first_name', [
                        'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span>{input}</div>',
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Сергей'])->label('Имя') ?>
                </div>

                <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'middle_name', [
                        'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span>{input}</div>',
                    ])->textInput(['maxlength' => true, 'placeholder' => 'Петрович'])->label('Отчество (при наличии)') ?>
                </div>
            </div>
            <br>
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
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'passport_ser')->textInput() ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'passport_num')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'ser_num_car')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12">
                    <?= $form->field($model, 'numb_car')->textInput(['maxlength' => true]) ?>
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