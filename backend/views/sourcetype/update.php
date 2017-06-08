<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\SourceType */

$this->title = Yii::t('common','修改渠道来源: ') . $model->source_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','渠道来源'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="source-type-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>