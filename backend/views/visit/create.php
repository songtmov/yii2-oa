<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CustomerVisit */

$this->title =Yii::t('common', 'Create Customer Visit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Customer Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-visit-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
