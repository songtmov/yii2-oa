<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerRecords */

$this->title = Yii::t('common','更改顾客术后回访: ') . $model->service_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','顾客术后回访列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->service_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="customer-records-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>