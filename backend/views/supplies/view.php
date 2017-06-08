<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\Category;
use common\models\Store;

/* @var $this yii\web\View */
/* @var $model common\models\Supplies */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Supplies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplies-view">

    <p>
        <!-- <?//= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
        <!-- <?//= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            // 'class' => 'btn btn-danger',
            // 'data' => [
            //     'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
            //     'method' => 'post',
            // ],
        ]) ?> -->
    </p>
    <?php 
        $Category = new Category();
        $Store = new Store();
        $model->store_id = $Store::find()->select('name')->where(['id' => $model->store_id])->one()['name'];
        $model->cate_id = $Category::find()->select('name')->where(['id' => $model->cate_id])->one()['name'];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'cate_id',
            'stock',
            'types',
            'store_id',
            'status',
            'stock_warning',
        ],
    ]) ?>

</div>
