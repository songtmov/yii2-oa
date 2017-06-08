<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */

$this->title = Yii::t('common','更改: ') . $model->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->client_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="customer-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'sale' => $sale,
    ]) ?>

</div>
<div class="clearfix"></div>