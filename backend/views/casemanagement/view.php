<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Customer;

/* @var $this yii\web\View */
/* @var $model common\models\CaseManagement */

$customer_model = new Customer();
$model -> customer_id = $customer_model::findOne($model->customer_id)['client_name'];

$this->title = $model->customer_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','病历列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-management-view">

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
    
    <?php
        
    ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'customer_id',
            // 'path',
            'nbackup:ntext',
            'submit_time',
        ],
    ]) ?>

</div>
