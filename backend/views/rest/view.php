<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Rest */

$username = User::find()->where(['id' => $model->user_id])->one()->username;
$this->title = $username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','调休列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rest-view">

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
            // 'user_id',
            ['attribute' => 'user_id','value' => $username],
            ['attribute' => 'full_time','value' => date('Y-m-d h:i:s',$model->full_time)],
            'rest_start_time',
            'rest_over_time',
            'department_opinion:ntext',
            'd_o_time',
            'manager_opinion:ntext',
            'm_o_time',
        ],
    ]) ?>

</div>

<?=Html::a(Yii::t('common','个人详情'), ['user/view', 'id' => $model->user_id], ['class' => 'btn btn-primary'])?>