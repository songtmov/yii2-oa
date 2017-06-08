<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','User Models'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// p($model->position);die;

?>
<div class="user-model-view">
    
    <p>
        <?= Html::a(Yii::t('common','Update'), ['up', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'username',
            'email:email',
            'telphone',
            [
                'attribute'=>'store_id',
                'format'=>'html',
                'value' => $model->store == null ?  '未设置' :  $model->store->name
            ],
            [
                'attribute'=>'position_id',
                'format'=>'html',
                'value' => $model->position == null ?  '未设置' :  $model->position->name
            ],
            [
                'attribute'=>'department_id',
                'format'=>'html',
                'value' => $model->department == null ?  '未设置' :  $model->department->name
            ],
            [
                'attribute'=>'status',
                'format'=>'html',
                'value'=>$model->status == 10?Html::a('正常','javascript:',['class'=>'btn btn-success btn-sm']):Html::a('禁用','javascript:',['class'=>'btn btn-danger btn-sm'])
            ],
            [
                'attribute'=>'login_time',
                'value' => date('Y-m-d H:i:s',$model->login_time)
            ],
            'login_ip',
            [
                'attribute'=>'created_at',
                'value'=>date('Y-m-d H:i:s',$model->created_at),
            ],
            [
                'attribute'=>'updated_at',
                'value'=>date('Y-m-d H:i:s',$model->updated_at),
            ]
        ],
    ]) ?>

</div>
