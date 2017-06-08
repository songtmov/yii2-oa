<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SupplieOrderDetail */

$this->title =Yii::t('common', 'Create Supplie Order Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplie Order Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplie-order-detail-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
