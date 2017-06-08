<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\CustomerRecords;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerRecords */

$this->title = '手术订单：'.$model->service_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户术后回访列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-records-view">

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
    <?php $CustomerRecords_model = new CustomerRecords();
        $model -> visited_mode = $CustomerRecords_model::$static[$model ->visited_mode];
        $model -> ishealthy = $CustomerRecords_model::$healthy[$model ->ishealthy];
     ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'pay',
            'visited_problem',
            'after_time',
            'operating_position',
            'visited_time',
            // 'visited_id',
            [
                'attribute' => 'visited_id',
                'value' => $user
            ],

            // 'visited_mode',
            [
                'attribute' => 'visited_mode',
            ],
            'visited_content',
            'bed_position',
            'ishealthy',
            'customer_detail:ntext',
            'service_id',
        ],
    ]) ?>

</div>

<a href="/billing/view/<?=$order_id->id?>"><button class="btn btn-primary">查看该订单详情</button></a>
