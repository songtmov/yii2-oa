<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

// $res = User::findOne(1) -> username;
// p($res);die;

/* @var $this yii\web\View */
/* @var $model common\models\meetapply */
$this->title = $model->ma_meetname;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','会务列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="meetapply-view">

    <p>
        <?= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->ma_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->ma_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php if ($model -> ma_type) {$model -> ma_type = "外部会议";}else{$model -> ma_type = "内部会议";}?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ma_id',
            'ma_content:ntext',
            'ma_meetname',
            'ma_countpeople',
            'ma_department',
            'ma_starttime',
            'ma_endtime',
            'ma_speaker',
            ['attribute' =>'ma_createtime','value' => date('Y-m-d h:i:s',$model -> ma_createtime)],
            'ma_type',
            'ma_meetaddress',
            'ma_remark:ntext',
            ['attribute' => 'ma_uid','value' => User::findOne($model -> ma_uid) -> username],
        ]
    ]) ?>

</div>
