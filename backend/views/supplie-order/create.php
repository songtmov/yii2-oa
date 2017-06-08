<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SupplieOrder */

$this->title =Yii::t('common', 'Create Supplie Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplie Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplie-order-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
