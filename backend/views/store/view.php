<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Store */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-view">

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
            'name',
            'province',
            'city',
            'area',
            'address',
            // 'Store_image',
            'acreage',
            // 'head_id',
            'contact_number',
            'store_created_time:datetime',
            'created_time:datetime',
            'updated_time:datetime',
        ],
    ]) ?>

</div>
