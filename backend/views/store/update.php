<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Store */

$this->title = Yii::t('common','修改医院信息: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','医院列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="store-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>

</div>
<div class="clearfix"></div>