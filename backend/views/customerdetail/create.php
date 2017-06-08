<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CustomerDetail */

$this->title =Yii::t('common', '客户详情创建表');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户列表'), 'url' => ['customer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <?php //p($res);die;?> -->
<div class="customer-detail-create col-md-offset-2 col-md-6">
	
    <?= $this->render('_form', [
        'model' => $model,
        'res' => $res
    ]) ?>

</div>
<div class="clearfix"></div>
