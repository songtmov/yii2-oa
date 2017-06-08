<?php
use yii\helpers\Html;
$this->registerCss('
    th{
        text-align:center;
    }
    table .form-group{
        margin-bottom: 0
    }
    .table-bordered > tbody > tr > td {
        padding: 8px 15px;
    }
');

/* @var $this yii\web\View */
/* @var $model common\models\BillingOperation */

$this->title =Yii::t('common', 'Create Billing Operation');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Billing Operations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// p($role);die;
?>
<div class="billing-operation-create">

    <?= $this->render('_form', [
        'model'=>$model,
        'data' => $data,
        'query'=>$query,
        'list' => $list,
        'role' => $role
    ]) ?>

</div>
<div class="clearfix"></div>
