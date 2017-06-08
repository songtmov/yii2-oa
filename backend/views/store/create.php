<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Store */

$this->title =Yii::t('common', '新增医院');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','医院列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>
	
</div>
<div class="clearfix"></div>
