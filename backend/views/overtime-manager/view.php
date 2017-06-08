<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\overtime */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Overtimes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overtime-view">

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
            'id',
            'user_id',
            'fill_time:datetime',
            'work_time',
            'work_address',
            'work_reason:ntext',
            'executive_opinion:ntext',
            'department_opinion:ntext',
            'manager_opinion:ntext',
        ],
    ]) ?>

</div>
