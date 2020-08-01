<?php
/**
 * Created by IntelliJ IDEA.
 * User: matjazz
 * Date: 06/01/16
 * Time: 10:06
 */

?>
<div class="container-fluid">
    <section class=" <?= (!Yii::$app->user->isGuest) ? 'card' :''?>">
        <?= $content ?>
    </section>
</div>
