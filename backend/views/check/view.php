<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Category;

/* @var $this yii\web\View */
/* @var $model common\models\Check */

$this->title = $model->time.'--盘点';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','盘点列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="check-view">

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
     $category_model = new Category();
     $model->cate_id = $category_model::find()->select('name')->where(['id' => $model->cate_id])->one()->name;
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'name',
            'cate_id',
            'item_id',
            'paper_num',
            'actual_num',
            'deviation',
            'deviation_reason:ntext',
            'remark:ntext',
        ],
    ]) ?>

</div>
