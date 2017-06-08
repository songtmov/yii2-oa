<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CustomerRecords */

$this->title =Yii::t('common', '创建客户术后回访');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户术后回访列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
// p($cate_id);die;
?>
<div class="customer-records-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'cate_id' => $cate_id
    ]) ?>

</div>
<div class="clearfix"></div>
