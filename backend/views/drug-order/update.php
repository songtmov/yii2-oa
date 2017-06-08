<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DrugOrder */

$this->title = Yii::t('common','Update Drug Order: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="drug-order-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>