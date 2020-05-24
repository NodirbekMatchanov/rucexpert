<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['action' => 'change-password']); ?>

<div class="registration-form ">

    <?= $form->field($model, 'oldPassword')->passwordInput(['autofocus' => true]) ?>
    <?= $form->field($model, 'newPassword')->passwordInput() ?>
    <?= $form->field($model, 'retypePassword')->passwordInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
