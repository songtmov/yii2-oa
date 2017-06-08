<?php

use yii\helpers\Html;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerDetail */

$this->title = Yii::t('common','更新客户: ') . $username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户列表'), 'url' => ['customer/index']];
$this->params['breadcrumbs'][] = ['label' => $username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="customer-detail-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'res' => $res
    ]) ?>

</div>
<div class="clearfix"></div>