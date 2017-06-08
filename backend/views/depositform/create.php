<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DepositForm */

$this->title =Yii::t('common', '创建定金事项');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','定金管理列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deposit-form-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
