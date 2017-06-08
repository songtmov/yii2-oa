<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Position */

$this->title =Yii::t('common', 'Create Position');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'department'=>$department
    ]) ?>

</div>
<div class="clearfix"></div>
