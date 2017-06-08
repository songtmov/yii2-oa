<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerVisit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Customer Visits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-visit-view">
    
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

            [
                'attribute' => 'customer_id',
                'value' => $model->customer->client_name
            ],
            [
                'attribute'=>'cause',
                'value' =>$model->cause == 0?'咨询':'手术'
            ],
            'details',
            [
                'attribute' => 'service_id',
                'value' =>$model->user->username
            ],
            [
                'attribute'=>'to_store_time',
                'value' => date('Y年m月d日 H:i:s',$model->to_store_time)
            ],
        ],
    ]) ?>

</div>
