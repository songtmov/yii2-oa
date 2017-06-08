<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Cstore */

$this->title = Yii::t('common','更新店家: ') . $model->store_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','店家列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->store_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','更改');
?>
<div class="cstore-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region
    ]) ?>

</div>
<div class="clearfix"></div>