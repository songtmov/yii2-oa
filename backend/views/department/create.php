<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Department */

$this->title =Yii::t('common', 'Create Department');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Departments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
