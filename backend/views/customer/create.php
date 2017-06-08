<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title =Yii::t('common', '创建客户');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-create col-md-offset-2 col-md-6">
	
    <?= $this->render('_form', [
        'model' => $model,
        'sale' => $sale
    ]) ?>

</div>
<div class="clearfix"></div>
