<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\photoType */

$this->title =Yii::t('common', '创建一个图片类型');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','图片类型列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-type-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
