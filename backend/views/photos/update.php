<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Photos */

$this->title = Yii::t('common','更改图片-订单号：') . $model->billing_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','图片列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->billing_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="photos-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>