<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RecordNursing */

$this->title = $customer;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','护理列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="record-nursing-view">
    
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
            'customer_profiles_id',
            // 'customer_id',
            [
                'attribute'=>'customer_id',
                'value' => $customer
            ],
            'record_date',
            'record_time',
            'body_tempreture',
            'blood_pressure',
            'pulse',
            'heart_rate',
            // 'nurse_id',
            [
                'attribute'=>'nurse_id',
                'value' => $nurse
            ],
            'create_time',
        ],
    ]) ?>

</div>
