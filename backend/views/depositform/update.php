<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DepositForm */

$this->title = Yii::t('common','Update Deposit Form: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Deposit Forms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="deposit-form-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>