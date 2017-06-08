<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SourceType */

$this->title =Yii::t('common', '创建渠道来源');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','渠道来源列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-type-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
