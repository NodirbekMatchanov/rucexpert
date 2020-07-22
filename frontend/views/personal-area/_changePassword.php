<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['action' => 'change-password']); ?>

<div class="registration-form ">

    <div class="row">
        <?= $form->field($model, 'oldPassword')->passwordInput(['autofocus' => true,'class' => 'form-control']) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'newPassword')->passwordInput(['class' => 'form-control']) ?>
    </div>
    <div class="row">
        <?= $form->field($model, 'retypePassword')->passwordInput(['class' => 'form-control']) ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
