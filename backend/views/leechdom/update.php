<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Leechdom */

$this->title = Yii::t('common','Update Leechdom: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Leechdoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="leechdom-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>

</div>
<div class="clearfix"></div>