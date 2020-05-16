<?php
 $active = (isset(Yii::$app->request->queryParams['rubric_id']) && Yii::$app->request->queryParams['rubric_id'] == $item->id) ? "active" : "";
 echo
     "<a href='" . \yii\helpers\Url::to(['news/index', 'rubric_id' => $item->id]) .

     " ' class='$active' >"
     . $item->title . "</a>"
?>


