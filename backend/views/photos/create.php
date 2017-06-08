<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Photos */

$this->title =Yii::t('common', '创建图片事项');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','图片事项列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
