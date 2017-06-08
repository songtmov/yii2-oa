<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SuppliesBuyerDetail */

$this->title =Yii::t('common', 'Create Supplies Buyer Detail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplies Buyer Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-buyer-detail-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
