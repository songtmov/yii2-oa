<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BillingOperation */

$this->title =Yii::t('common', 'Create Billing Operation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Billing Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="billing-operation-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
