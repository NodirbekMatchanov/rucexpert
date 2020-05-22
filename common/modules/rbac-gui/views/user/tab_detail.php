<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */
/* @var $hotels \common\models\Hotels */
/* @var $tab_id */
?>

<?php if ($tab_id == 1): ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email:email',
            'created_at:date',
        ],
    ])
    ?>

<?php else: ?>
    <?php if (!empty($hotels)): ?>
        <?=
        DetailView::widget([
            'model' => $hotels,
            'attributes' => [
                'company',
                'phone',
                'license_id',
                'license_date',
                'count_bonus_find',
                'reg_hotel_type',
                'reg_car_type',
                'reg_rent_type',
                'balance',
            ],
        ])
        ?>
    <?php endif; ?>
<?php endif; ?>
