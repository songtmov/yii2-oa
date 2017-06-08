<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Region */

$this->title = Yii::t('common','Update Region: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="region-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>