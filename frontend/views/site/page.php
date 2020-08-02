<?php

use yii\helpers\Html;

$this->title = $page->title ?? '';

?>
<div style="margin-top: 100px">
    <?=$page->content ?? ''?>
</div>
