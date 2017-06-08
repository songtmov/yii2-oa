<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SuppliesBuyerOrder */

$this->title =Yii::t('common', 'Create Supplies Buyer Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplies Buyer Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-buyer-order-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'modelsAddress' => (empty($modelsAddress))? [new SuppliesBuyerDetail()] : $modelsAddress,
        'cate' => $cate
    ]) ?>

</div>
<div class="clearfix"></div>
