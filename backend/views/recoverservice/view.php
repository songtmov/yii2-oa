<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\RecoverService */

$this->title = '手术订单号:'.$model->billing_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','客户服务列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recover-service-view">

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
            'most_satisfied',
            'not_most_satisfied',
            'billing_id',
            'description:ntext',
            'grade',
        ],
    ]) ?>

</div>

<a href="/billing/view/<?=$order_id->id?>"><button class="btn btn-primary">查看该订单详情</button></a>

