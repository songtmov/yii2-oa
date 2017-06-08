<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ReturnVisit */

$this->title = Yii::t('common','Update Return Visit: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Return Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="return-visit-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>