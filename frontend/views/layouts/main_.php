<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 07:52
 */

use yii\helpers\Html;

/* @var $this \yii\web\View */

/* @var $content string */

use yii\widgets\Breadcrumbs;
if(!Yii::$app->user->isGuest){
    backend\assets\AppAsset::register($this);
}
//backend\assets\InspiniaAsset::register($this);

//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/smartysoft/yii2-smartysoft-inspinia/assets');

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="horizontal-layout horizontal-menu 2-columns  navbar-floating footer-static" data-open="hover"
      data-menu="horizontal-menu" data-col="2-columns" style="margin-bottom: 15%">
<?php $this->beginBody() ?>

<?php if (!Yii::$app->user->isGuest) : ?>
    <?= $this->render('header.php') ?>
<?php endif; ?>
<?php if (!Yii::$app->user->isGuest) : ?>
    <?= $this->render('sidebar.php') ?>
<?php endif; ?>
<div class="container" style="padding-top: 160px">
    <?=\diecoding\toastr\ToastrFlash::widget();?>
    <?php if(Yii::$app->session->hasFlash('success')):?>
        <div class="alert alert-success" role="alert">
            <p class="mb-0">
                <?=Yii::$app->session->getFlash('success')?>
            </p>
        </div>
    <?php endif;?>
    <?php if(Yii::$app->session->hasFlash('error')):?>
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">
                <?=Yii::$app->session->getFlash('error')?>
            </p>
        </div>
    <?php endif;?>
    <?= $this->render('content.php', ['content' => $content]) ?>

</div>

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>


<?php $this->endBody() ?>
<?php if (!Yii::$app->user->isGuest) : ?>
    <?= $this->render('footer.php', []) ?>
<?php endif; ?>
<script src="/admin/js/bootstrap-datepicker.js"></script>

</body>
</html>
<?php $this->endPage() ?>
