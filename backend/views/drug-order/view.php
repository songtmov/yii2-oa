<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\DrugOrder;

/* @var $this yii\web\View */
/* @var $model common\models\DrugOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Drug Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="drug-order-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bill_id',
            [
                'attribute'=>'client_id',
                'value' => $model->client->client_name,
            ],
            'order_number',
            [
                'attribute'=>'amount',
                'format'=>'html',
                'value' => '<b class="red">'.$model->amount.'</b>',
            ],

            [
                'attribute' => 'store_id',
                'value' => $model->store->name,
            ],
            [
                'attribute' => 'status',
                'value' => DrugOrder::$state[$model->status],
            ],
            [
                'attribute'=>'created_time',
                'value' => date('Y年m月d日 H时i分s秒',$model->created_time),
            ],
            [
                'attribute'=>'hakim_id',
                'value' => $model->hakim->username
            ],
            [
                'attribute'=>'updated_time',
                'label' => '收款时间',
                'value' => empty($model->updated_time)?'暂未收款':date('Y年m月d日 H时i分s秒',$model->updated_time),
            ]
        ],
    ]) ?>
    <p style="text-align:center">
        <?php if($model->status == 100):?>
            <?= Html::a('确认收款', ['update', 'id' => $model->id], [
                'class' => 'btn btn-primary',
                'data' => [
                    'confirm'=>'您确定已收到该款项了吗?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif?>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
