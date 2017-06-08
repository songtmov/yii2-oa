<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Department */

$this->title = Yii::t('common','Update Department: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="department-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>