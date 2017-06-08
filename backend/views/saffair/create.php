<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\saffair */

$this->title =Yii::t('common', '新增预约');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','预约列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// p($region);
?>
<div class="saffair-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>

</div>
<div class="clearfix"></div>
