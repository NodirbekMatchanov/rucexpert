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
//    backend\assets\AppAsset::register($this);
    backend\assets\AreaAsset::register($this);

}

//backend\assets\InspiniaAsset::register($this);

//$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/smartysoft/yii2-smartysoft-inspinia/assets');

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light%7CPlayfair+Display:400"
          rel="stylesheet" type="text/css">
    <script type="text/javascript"
            src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="horizontal-layout horizontal-menu 2-columns  navbar-floating footer-static" data-open="hover"
      data-menu="horizontal-menu" data-col="2-columns" >
<?php $this->beginBody() ?>


<?php if (!Yii::$app->user->isGuest) : ?>
    <?= $this->render('header.php') ?>
<?php endif; ?>
<?php if (!Yii::$app->user->isGuest) : ?>
<div class="inner-wrapper">
    <section role="main" class="content-body">
        <?= $this->render('sidebar.php') ?>
        <?php endif; ?>

        <?= \diecoding\toastr\ToastrFlash::widget(); ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success" role="alert">
                <p class="mb-0">
                    <?= Yii::$app->session->getFlash('success') ?>
                </p>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger" role="alert">
                <p class="mb-0">
                    <?= Yii::$app->session->getFlash('error') ?>
                </p>
            </div>
        <?php endif; ?>

        <?= $this->render('content.php', ['content' => $content]) ?>


        <div class="sidenav-overlay"></div>
        <div class="drag-target"></div>


        <?php $this->endBody() ?>
        <?php if (!Yii::$app->user->isGuest) : ?>
    </section>
</div>
<?= $this->render('footer.php', []) ?>
<?php endif; ?>
<?php if (!Yii::$app->user->isGuest) : ?>
<!--<script src="/admin/js/bootstrap-datepicker.js"></script>-->
<script src="https://lidrekon.ru/slep/js/uhpv-full.min.js"></script>
<?php endif; ?>

</body>
</html>
<?php $this->endPage() ?>
