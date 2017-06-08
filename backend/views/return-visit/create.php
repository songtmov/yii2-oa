<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ReturnVisit */

$this->title =Yii::t('common', 'Create Return Visit');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Return Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="return-visit-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'client'=> $client
    ]) ?>

</div>
<div class="clearfix"></div>
