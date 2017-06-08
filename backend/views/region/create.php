<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Region */

$this->title =Yii::t('common', 'Create Region');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Regions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
