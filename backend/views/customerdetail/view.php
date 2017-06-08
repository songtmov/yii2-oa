<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Customer;
use common\models\CustomerDetail;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerDetail */
$use = new Customer();
$this->title = $use::find()->where(['id' => $model->customer_id])->one()->client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','顾客信息详情表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->customer_id = $this->title;
?>
<div class="customer-detail-view">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'customer_id',
            'filecode',
            'customer_birthday',
            'husband_birthday',
            'merry_day',
            'children_birthday',
            // 'customer_nature',
            [
                'attribute' => 'customer_nature',
                'value' => CustomerDetail::$customer_nature[$model->customer_nature]
            ],
            [
                'attribute' => 'pay_times',
                'value' => CustomerDetail::$pay_times[$model->pay_times]
            ],
            [
                'attribute' => 'habit',
                'value' => CustomerDetail::$habit[$model->habit]
            ],
            [
                'attribute' => 'attitude',
                'value' => CustomerDetail::$attitude[$model->attitude]
            ],
            [
                'attribute' => 'emotion',
                'value' => CustomerDetail::$emotion[$model->emotion]
            ],
            [
                'attribute' => 'care_about',
                'value' => CustomerDetail::$care_about[$model->care_about]
            ],
            [
                'attribute' => 'hobby',
                'value' => CustomerDetail::$hobby[$model->hobby]
            ],
            // 'pay_times',
            // 'habit',
            // 'attitude',
            // 'emotion',
            // 'care_about',
            // 'hobby',
            'years',
            'total_sals',
            'healthy',
            'plastic_items',
            'plastic_part',
            'attidute',
            'hospital',
            'old_manner',
            // 'buy_type',
            [
                'attribute' => 'buy_type',
                'value' => CustomerDetail::$type[$model->buy_type]
            ],
            [
                'attribute' => 'all_evaluate',
                'value' => CustomerDetail::$all_evaluate[$model->all_evaluate]
            ],
            [
                'attribute' => 'is_old_customer',
                'value' => CustomerDetail::$is_old_customer[$model->is_old_customer]
            ],
            // 'all_evaluate',
            // 'is_old_customer',
            'backup:ntext',
        ],
    ]) ?>

</div>
