<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\overtime */

$this->title =Yii::t('common', 'Create Overtime');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Overtimes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overtime-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
