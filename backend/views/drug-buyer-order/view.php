<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\DrugBuyerOrder;

/* @var $this yii\web\View */
/* @var $model common\models\DrugBuyerOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Buyer Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-buyer-order-view">

    <p>
        <!-- <?//= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
        <!-- <?//= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            // 'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
            //     'method' => 'post',
            // ],
        ]) ?> -->
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'buyer_number',
            [
                'attribute'=>'store_id',
                'value' =>$model->store->name
            ],
            [
                'attribute'=>'status',
                'value' => DrugBuyerOrder::$state[$model->status]
            ],
            [
                'attribute'=>'applicant_id',
                'value'=>$model->applicant->username
            ],
            [
                'attribute'=>'buyer_id',
                'value' => $model->buyer_id?$model->buyer->username:'' 
            ],
         
            [
                'attribute'=> 'created_time',
                'value' => date('Y-m-d H:i:s',$model->created_time)
            ],
            ['attribute'=>'updated_time',
                'value'=>$model->updated_time?date('Y-m-d H:i:s',$model->updated_time):''
            ]
        ],
    ]) ?>

</div>
