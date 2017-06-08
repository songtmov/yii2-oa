<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Position */

$this->title = Yii::t('common','更改职位: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="position-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'department' => $department
    ]) ?>

</div>
<div class="clearfix"></div>