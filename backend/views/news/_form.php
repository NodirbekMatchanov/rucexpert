<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card">

    <div class="card-body">

        <?php $form = ActiveForm::begin(); ?>


        <div class="row">
            <div class="col-md-6 col-lg-6">
                <?= $form->field($model, 'rubric_id')->widget(Select2::className(), [
                    'data' => \backend\models\Rubric::getAll(),
                ]) ?>
            </div>
            <div class="col-md-6 col-lg-6">
                <?= '<label>Дата публикация</label>'.
                DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'date',
                    'language' => 'ru',
                    'options' => ['placeholder' => '22.01.2020','class' => 'form-control'],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd.mm.yyyy'
                    ]
                ]);
                ?>
            </div>
        </div>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'content')->widget(\mihaildev\ckeditor\CKEditor::className(), [
            'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', []),
        ]);
        ?>

        <?= $form->field($model, 'short_content')->textarea(['maxlength' => true]) ?>

        <?= $form->field($model, 'creator')->textInput(['maxlength' => true, 'class' => 'hidden', 'value' => \Yii::$app->user->identity->username])->label(false) ?>

        <?= $form->field($model, 'video')->textarea(['row' => 10]) ?>


        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <?=
                $form->field($model, 'videoFile')->widget(\kartik\file\FileInput::className(), [
                    'language' => 'ru',
                     'pluginOptions' => [
        'showPreview' => false,
        'showCaption' => true,
        'showRemove' => true,
        'showUpload' => false
    ],
                    'options' => ['multiple' => false],
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <?=
                $form->field($model, 'image')->widget(\kartik\file\FileInput::className(), [
                    'language' => 'ru',
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false
                    ],
                    'options' => ['multiple' => false],
                ]) ?>
            </div>
        </div>

        <?php if (Yii::$app->controller->action->id === 'update' && $model->img != ''): ?>
            <div class="row">
                <div class="col-md-4">
                    <?= Html::img('/uploads/news/' . $model->img, ['class' => 'img img-thumbnail']) ?>
                    <p><a href="<?= \yii\helpers\Url::to(['/news/delete-image', 'id' => $model->id]) ?>"
                          class="btn btn-danger">Удалить <span class="fa fa-trash"></span></a></p>
                </div>
            </div>

        <?php endif; ?>

        <div class="form-group pull-right">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
