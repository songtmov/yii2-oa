<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CustomerFollow */

$this->title =Yii::t('common', '创建客户跟进');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-follow-create col-md-offset-2 col-md-6">
	
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
