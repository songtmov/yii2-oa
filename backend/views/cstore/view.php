<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Cstore */

$this->title = $model->store_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','店家列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cstore-view">
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
        // 'address' => $address
        'attributes' => [
            // 'id',
            'store_name',
            // 'province',
            // ['attribute' => 'province','value' => $address['province']],
            // ['attribute' => 'city','value' => $address['city']],
            // ['attribute' => 'area','value' => $address['area']],
            // 'city',
            // 'area',
            'adress',
            // 'hospital',
            ['attribute' => 'hospital','value' => $hospital],
            'create_time',
            'telephone',
            'acreage',
            // 'store_photo',
            // ['attribute' => 'store_photo','format' => 'html','value' => Html::img($model->store_photo)],
            'boss',
            // 'boss_photo',
            // ['attribute' => 'store_photo','format' => 'html','value' => Html::img($model->boss_photo)],
            'encamp',
            'consultation',
            'business',
        ],
    ]) ?>

</div>
