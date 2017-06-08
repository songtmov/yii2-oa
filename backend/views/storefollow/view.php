<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\StoreFollow;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\StoreFollow */

$this->title = $model->store_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','美容院跟进列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="store-follow-view">

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
    <?php $model -> cooperation = StoreFollow::$cooperation[$model -> cooperation];?>
    <?php 
        $user_model = new User();
        $model -> user_id = $user_model::find()->select('username')->where(['id' => $model -> user_id])->one()['username'];
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'content:ntext',
            [
                'attribute' => 'cooperation',
            ],
            'fail_reason',
            'user_id',
            'backup',
            'sub_time',
            // 'store_name',
            [
                'attribute' => 'store_name'
            ],
            'phone',
            'boss',
        ],
    ]) ?>

</div>
