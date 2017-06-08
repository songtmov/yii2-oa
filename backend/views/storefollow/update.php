<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\StoreFollow */

$this->title = Yii::t('common','修改合作商跟进商: ') . $model->store_name .'在'.$model->sub_time.'的记录';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','合作商跟进列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->store_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="store-follow-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>