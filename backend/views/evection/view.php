<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Evection */

$this->title = $model->evection_info;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Evections'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evection-view">
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
            'province',
            'city',
            [
                'attribute'=>'user_id',
                'value' => \common\models\UserModel::find()->select('username')->where(['id'=>$model->user_id])->one()['username'],
            ],
            [
                'attribute'=>'store_id',
                'value' => \common\models\CStore::find()->select('store_name')->where(['id'=>$model->store_id])->one()['store_name'],
            ],
            'evection_time',
            'evection_reason',
            'evection_info',
            [
                'attribute'=>'created_time',
                'value' => date('Y-m-d h:i:s',$model->created_time)
            ],
            [
                'attribute'=>'updated_time',
                'value' => date('Y-m-d h:i:s',$model->updated_time)
            ],
        ],
    ]) ?>

</div>
