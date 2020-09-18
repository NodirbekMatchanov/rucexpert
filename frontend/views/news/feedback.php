<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

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
            <?= $form->field($model, 'attachFile')->fileInput() ?>
            <?= $form->field($model, 'reCaptcha')->widget(
                \himiklab\yii2\recaptcha\ReCaptcha3::className(),
                [
                    'siteKey' => '6LfFrc0ZAAAAACPaUOuR3n842yTAHs_FnE5SP4lP', // unnecessary is reCaptcha component was set up
                    'action' => 'feed-back',
                ]
            ) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

