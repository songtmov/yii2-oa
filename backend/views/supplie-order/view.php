<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SupplieOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplie Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplie-order-view">


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bill_id',
            [
                'attribute'=>'client_id',
                'value' => $model->client->client_name
            ],
            'order_number',

            [
                'attribute'=>'store_id',
                'value' => $model->store->name
            ],
            [

                'attribute'=> 'hakim_id',
                'value' => $model->hakim->username
            ],
            'status',
            [
                'attribute'=>'created_time',
                'value' => date('Y-m-d H:i:s',$model->created_time)
            ],
             [
                'attribute'=>'updated_time',
                'value' => !empty($model->updated_time)?date('Y-m-d H:i:s',$model->updated_time):''
            ],
        ],
    ]) ?>

    <p style="text-align:center">
        <?= Html::a('等待收款', 'javascript:', ['class' => 'btn btn-primary']) ?>
    </p>

</div>
