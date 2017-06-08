<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SurgicalItems */

$this->title = Yii::t('common','Update Surgical Items: ') . $model->entry_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Surgical Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->entry_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="surgical-items-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'list' =>$list
    ]) ?>

</div>
<div class="clearfix"></div>