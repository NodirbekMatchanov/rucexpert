<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->title = 'Импорт';
/* @var $importForm backend\models\ImportForm */

?>

<div class="card">
    <div class="card-body card-dashboard">

        <div class="card-body ">
            <h3>Импорт из csv файла</h3>

            <?php $form = ActiveForm::begin(); ?>

            <h5> Выберите файл <a download="" href="/backend/web/example/rowdys.csv">Скачать
                    пример
                    Csv
                    файла</a></h5>
            <div class="row">
                <?=
                $form->field($importForm, 'file')->widget(\kartik\file\FileInput::classname(), [
                    'options' => ['multiple' => false, 'accept' => '*'],
                    'pluginOptions' => [
                        'showPreview' => false,
                        'showCaption' => true,
                        'showRemove' => true,
                        'showUpload' => false]
                ])->label('Csv файл')
                ?>

            </div>
            <div class="row">
                <div class="form-group">
                    <?= Html::submitButton('Импорт', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>



