<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MeetingConvey */

$this->title = Yii::t('common','更改--会议传达表（市场部）: ') . $model->meeting_topic;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','会议传达表列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->meeting_topic, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('common','Update');
?>
<div class="meeting-convey-update col-md-6 col-md-offset-2">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<div class="clearfix"></div>