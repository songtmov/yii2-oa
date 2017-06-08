<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\meetapply */

$this->title = Yii::t('common','更新会务：') . $model->ma_meetname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','会务列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ma_meetname, 'url' => ['view', 'id' => $model->ma_id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="meetapply-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>