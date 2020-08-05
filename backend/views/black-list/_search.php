<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Поиск';

?>

<?php $this->beginBlock('sidebar'); ?>
<h2><?= $this->title ?></h2>
<?php $this->endBlock(); ?>

    <?php $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'post',
    ]); ?>
<div class="col-lg-12 form-group">
   <p> Заполните одно из полей на Ваш выбор. Поля со знаком (*), обязательны для заполнения.</p>
</div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'type_org')->dropDownList($model->type_db) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12 hidden">
            <?= $form->field($model, 'searching')->textInput(['maxlength' => true,'class' => 'hidden','value' => true])->label(false) ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'last_name',[
                'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span>{input}</div>',
            ])->textInput(['maxlength' => true,'placeholder' => 'Иванов'])->label('Фамилия') ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'first_name',[
                'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span>{input}</div>',
            ])->textInput(['maxlength' => true,'placeholder' => 'Сергей'])->label('Имя') ?>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'middle_name',[
                'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-user"></i>
												</span>
											</span>{input}</div>',
            ])->textInput(['maxlength' => true,'placeholder' => 'Петрович'])->label('Отчество (при наличии)')  ?>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'email',[
                'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-envelope"></i>
												</span>
											</span>{input}</div>',
            ])->textInput(['maxlength' => true,'placeholder' => 'mail@domain.com'])->label('E-mail') ?>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'phone',[
                'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-phone"></i>
												</span>
											</span>{input}</div>',
            ])->textInput(['maxlength' => true,'placeholder' => 'номер телефона'])->label('Телефон') ?>
        </div>

        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <?= $form->field($model, 'date_born',[
                'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-calendar"></i>
												</span>
											</span>{input}</div>',
            ])->textInput(['maxlength' => true,'placeholder' => '01/01/2000'])->label('Дата рождения') ?>
        </div>
    </div>
<br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'place_born',[
            'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-globe"></i>
												</span>
											</span>{input}</div>',
        ])->textInput(['maxlength' => true,'placeholder' => 'Страна, Область (штат), Город'])->label('Место рождения') ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <?= $form->field($model, 'ser_num_car',[
            'template' => '{label}<div class="input-group"><span class="input-group-prepend">
												<span class="input-group-text">
													<i class="fas fa-list-alt"></i>
												</span>
											</span>{input}</div>',
        ])->textInput(['maxlength' => true,'placeholder' => '00 00 0000'])->label('Серия и номер документа дающего право на управление транспортным средством') ?>
    </div>
</div>
    <br>
    <div class="form-group text-center">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>
<br>

    <?php ActiveForm::end(); ?>

