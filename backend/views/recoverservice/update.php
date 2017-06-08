<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RecoverService */

$this->title = Yii::t('common','修改顾客术后调查（订单号）: ') . $model->billing_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','顾客术后调查列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->billing_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="recover-service-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>