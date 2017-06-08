<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MeetingConvey */

$this->title =Yii::t('common', '创建会议传达表（市场部）');
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','会议传达表列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-convey-create col-md-offset-2 col-md-6">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>
