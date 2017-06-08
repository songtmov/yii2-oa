<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\saffair */

$this->title = $model->customer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','预约列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saffair-view">

    <p>
        <?= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'customer',
            // 'province',
            ['attribute' =>'province','value' => $res['province']],
            ['attribute' =>'city','value' => $res['city']],
            ['attribute' =>'hospital','value' => $res['hospital']],
            ['attribute' =>'appointment_type','value' => $res['appointment_type']],
            ['attribute' =>'doctor','value' => $res['doctor']],
            // 'city',
            // 'hospital',
            'appointment',
            // 'appointment_type',
            // 'doctor',
            'remark:ntext',
        ],
    ]) ?>

</div>
