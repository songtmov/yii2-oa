<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\photoType */

$this->title = Yii::t('common','修改图片类行: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','图片类行列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="photo-type-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>