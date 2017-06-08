<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;
use common\models\DepositForm;

/* @var $this yii\web\View */
/* @var $model common\models\DepositForm */

$user_model = new User();
$depositform_model = new DepositForm();

$this->title = $model->billing_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','定金管理列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="deposit-form-view">

    <!-- <p> -->
        <!-- <?//= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
        <!-- <?//= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            // 'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
            //     'method' => 'post',
            ],
        ]) ?> -->
    <!-- </p> -->
    <?php 
        $model -> payment_method = $depositform_model::$static[$model -> payment_method];
        $model -> user_id = $user_model::find()->select('username')->where(['id' => $model -> user_id])->one()['username'];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'billing_id',
            'deposit',
            'payment_method',
            'user_id',
            'sub_time',
            'nbackup:ntext',
        ],
    ]) ?>

</div>

<a href="/billing/view/<?=$order_id->id?>"><button class="btn btn-primary">查看该订单详情</button></a>
