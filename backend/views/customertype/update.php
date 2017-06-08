<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerType */

$this->title = Yii::t('common','更改: ') . $model->customer_type;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','顾客类型列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->customer_type, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="customer-type-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>