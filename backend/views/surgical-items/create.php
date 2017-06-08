<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SurgicalItems */

$this->title =Yii::t('common', 'Create Surgical Items');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Surgical Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surgical-items-create col-md-offset-2 col-md-6">
	
    <?= $this->render('_form', [
        'model' => $model,
        'list' => $list
    ]) ?>
	
</div>
<div class="clearfix"></div>
