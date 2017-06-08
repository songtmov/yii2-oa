<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\MeetingConvey */

$this->title = $model->meeting_topic;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','会务传达列表（市场部）'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meeting-convey-view">

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
            // 'meeting_type',
            [
                'attribute' => 'meeting_type',
                'value' => \common\models\MeetingConvey::$status[$model->meeting_type],
            ],
            'meeting_topic',
            'meeting_address',

            // 'cstore_id',
            [
                'attribute' => 'cstore_id',
                'value' => \common\models\Cstore::find()->select('store_name')->where(['id' => $model->cstore_id])->one()['store_name'],
            ],
            'cstore_address',
            'owner_id',
            'owner_phone',
            'cstore_number',
            'cstore_area',
            'manager_id',
            'manager_phone',
            'emplyees_number',
            'training_date',
            'hotel_name',
            'hotel_address',
            'hotel_floor',
            'instructor_id',
            'cameraman_id',
            'engineer_id',
            // 'doctor_id',
            [
                'attribute' => 'doctor_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id' => $model->doctor_id])->one()['username'],
            ], 
            [
                'attribute' => 'host_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id' => $model->host_id])->one()['username'],
            ],[
                'attribute' => 'asistant_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id' => $model->asistant_id])->one()['username'],
            ],[
                'attribute' => 'consultant_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id' => $model->consultant_id])->one()['username'],
            ],[
                'attribute' => 'nurse_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id' => $model->nurse_id])->one()['username'],
            ],[
                'attribute' => 'resident_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id' => $model->resident_id])->one()['username'],
            ],
            'travel_arrangement:ntext',
            'ticket',
            'draw',
            'invitation',
            'box',
            'vehicle_type',
            'renter_id',
            'marketing_responsible_id',
            'meeting_responsible_id',
            'ko_solution:ntext',
            'place_solution:ntext',
            'creattime',
            'comment:ntext',
        ],
    ]) ?>

</div>
