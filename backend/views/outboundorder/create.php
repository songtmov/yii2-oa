<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OutboundOrder */

$this->title =Yii::t('common', '新增物品出库');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','物品出库列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="outbound-order-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'cate_id' => $cate_id
    ]) ?>

</div>
<div class="clearfix"></div>
