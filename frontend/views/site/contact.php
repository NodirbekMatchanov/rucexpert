<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

?>
<?php \yii\widgets\Pjax::begin(); ?>

<div class="site-contact">
    <?php
    if(Yii::$app->session->hasFlash('success')):
        ?>
    <div class="alert alert-success">
        <div>
            <?php echo Yii::$app->session->getFlash('success')?>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form','action' => '/site/contact','options' => [ 'data-pjax' => true]]); ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'phone') ?>

                <?= $form->field($model, 'subject')->dropDownList(\frontend\models\ContactForm::getSubjects()) ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

<!--                --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//                ]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php \yii\widgets\Pjax::end(); ?>
