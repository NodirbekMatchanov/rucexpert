<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Добавить новость'
?>


<div class="site-signup container" style="margin-top: 100px; margin-bottom: 100px">
    <h3>
        Добавить новость
    </h3>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-feedback']); ?>

            <?= $form->field($model, 'fullName')->textInput([]) ?>
            <?= $form->field($model, 'email')->label('Email') ?>

            <?= $form->field($model, 'phone')->textInput(['id' => 'phone']) ?>
            <?= $form->field($model, 'text')->widget(\mihaildev\ckeditor\CKEditor::className(), [
                'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', []),
            ]) ?>
            <?= $form->field($model, 'attachFile')->widget(\kartik\file\FileInput::className(), [
                'language' => 'ru',
                'pluginOptions' => [
                    'showPreview' => false,
                    'showCaption' => false,
                    'showRemove' => false,
                    'showUpload' => false
                ],
            ]) ?>
            <div class="col-md-3">
                <?= $form->field($model, 'reCaptcha')->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha2::className()
                ) ?>
                <div class="form-group">
            </div>
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>


