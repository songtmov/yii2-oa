<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DrugOrderDetail */

$this->title =Yii::t('common', 'Create Drug Order Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Order Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-order-detail-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
