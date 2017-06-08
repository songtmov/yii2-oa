<?php

use yii\helpers\Html;
use common\models\DrugOrderDetail;

/* @var $this yii\web\View */
/* @var $model common\models\DrugOrder */

$this->title =Yii::t('common', 'Create Drug Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-order-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list,
        'cate' => $cate,
        'modelsAddress' => (empty($modelsAddress)) ? [new DrugOrderDetail()] : $modelsAddress
    ]) ?>

</div>
<div class="clearfix"></div>
