<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Check */

$this->title = Yii::t('common','修改: ') . $model->time.'的盘点';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Checks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->time, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="check-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'cate_id' => $cate_id
    ]) ?>

</div>

<div class="clearfix"></div>