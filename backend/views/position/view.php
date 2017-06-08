<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Department;

/* @var $this yii\web\View */
/* @var $model common\models\Position */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Positions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-view">
    
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
    $department_model = new Department();
    $model->department_id = $department_model::find()->select('name')->where(['id'=>$model->department_id])->one()['name'];
    $model -> status ? $model -> status = '显示' : $model -> status = '隐藏' ;
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'department_id',
            'name',
            'status',
            'found_time:datetime',
        ],
    ]) ?>

</div>
