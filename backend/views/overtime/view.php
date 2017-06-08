<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

$usermodel = new User();
$this->title = Yii::t('common','') . $usermodel -> find() -> where(['id' => $model->user_id]) -> one() -> username .'在'. date('Y-m-d h:i:s',$model -> fill_time).'加班事宜';

$this->params['breadcrumbs'][] = ['label' => Yii::t('common','加班列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="overtime-view">

    <p>
        <!-- <?//= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->

        <!-- <?//= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            //'class' => 'btn btn-danger',
            // 'data' => [
                // 'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                // 'method' => 'post',
            //],
        //]) ?> -->

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'user_id',
            ['attribute'=>'user_id','value' => $username],
            ['attribute'=>'fill_time','value' => date('Y-m-d h:i:s',$model->fill_time)],
            // 'fill_time',
            'work_time',
            'work_address',
            'work_reason:ntext',
            // 'executive_opinion:ntext',
            // 'department_opinion:ntext',
            // 'manager_opinion:ntext',
        ],
    ]) ?>

</div>

<!-- <?//=Html::a(Yii::t('common','个人详情'), ['user/view', 'id' => $model->user_id], ['class' => 'btn btn-primary'])?> -->