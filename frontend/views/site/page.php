<?php

use yii\helpers\Html;

$this->title = $page->title ?? '';

?>
<?php $this->beginBlock('meta'); ?>
<meta name="keywords" content="<?= $page->tags ?? ''?>">
<?php $this->endBlock(); ?>
<div style="margin-top: 100px">
    <?= $page->content ?? '' ?>
</div>
