<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DrugBuyerDetail */

$this->title = Yii::t('common','Update Drug Buyer Detail: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Buyer Details'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="drug-buyer-detail-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>