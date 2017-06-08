<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Evection */

$this->title =Yii::t('common', 'Create Evection');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Evections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evection-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>

</div>
<div class="clearfix"></div>
