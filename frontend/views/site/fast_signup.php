<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Подтвердите код';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-signup">

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'form-signup','method' => 'post']); ?>

            <?= $form->field($model, 'code')->textInput(['class' => 'form-control']) ?>

            <?= $form->field($model, 'phone')->textInput(['id' => 'phone', 'class' => 'hidden'])->label(false) ?>


            <?= $form->field($model, 'email')->textInput(['class' => 'hidden'])->label(false) ?>

            <div class="form-group">
                <?= Html::a('Подтвердит','#', ['class' => 'btn btn-primary signup-button']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
