<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\OrderPay */

$this->title =Yii::t('common', '创建手术收费事项');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','手术收费列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-pay-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>

</div>
<div class="clearfix"></div>
