<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\saffair */

$this->title = Yii::t('common','预约修改: ') . $model->customer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Saffairs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="saffair-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region,
    ]) ?>

</div>
<div class="clearfix"></div>