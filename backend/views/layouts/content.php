<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 10:06
 */

?>
<div class="content-wrapper ">
    <div class="content-header row">
    </div>
    <div class="content-body"  <?=(!Yii::$app->user->isGuest)?'style="padding-top: 12%"' : '' ?>>
        <?= $content ?>
    </div>
</div>
