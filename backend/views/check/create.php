<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Check */

$this->title =Yii::t('common', '创建盘点');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','盘点列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'cate_id' => $cate_id,
    ]) ?>

</div>
<div class="clearfix"></div>
