<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Leechdom */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Leechdoms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leechdom-view">

    <!-- <p> -->
        <!-- <?//= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
        <!-- <?
        // = Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
        //     'class' => 'btn btn-danger',
        //     'data' => [
        //         'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
        //         'method' => 'post',
        //     ],
        // ]) 
        ?> -->
    <!-- </p> -->

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'cate_id',
            'number',
            'stock',
            'types',
            'standard',
            'guide_price',
            'status',
            'stock_warning',
            'store_id',
            'created_time:datetime',
            'updated_time:datetime',
        ],
    ]) ?>

</div>
