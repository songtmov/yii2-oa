<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DrugBuyerOrder */

$this->title =Yii::t('common', 'Create Drug Buyer Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Buyer Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-buyer-order-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'cate' => $cate,
        'modelsAddress' => (empty($modelsAddress)) ? [new DrugBuyerDetail()] : $modelsAddress
    ]) ?>

</div>
<div class="clearfix"></div>
