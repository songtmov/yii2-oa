<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\PhotoType;

/* @var $this yii\web\View */
/* @var $model common\models\Photos */
$client_name = \common\models\Customer::findOne(['id' => $model->customer_id])->client_name;
$this->title = $client_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','图片列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photos-view">
    
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
            // 'customer_id',
            [
                'attribute' => 'customer_id',
                'value' => \common\models\Customer::findOne(['id' => $model->customer_id])->client_name,
            ],
            'billing_id',
            [
                'attribute' => 'path',
                'format'=>'html',
                'value' => '<img src="'.$model->path.'" style="width:60px;">',
            ],
            'photo_name',
            [
                'attribute' => 'photo_type',
                'value' => PhotoType::findOne(['id' => $model->photo_type])->name,
            ],
            'remark',
        ],
    ]) ?>

</div>
