<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\OutboundOrder */

$this->title = Yii::t('common','Update Outbound Order: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Outbound Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="outbound-order-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'cate_id' => $cate_id
    ]) ?>

</div>
<div class="clearfix"></div>