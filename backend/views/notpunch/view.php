<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\Notpunch */

$this->title = User::find()->where(['id'=>$model -> user_id])->one()->username.'--'.$model -> full_time;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','未打卡列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notpunch-view">

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
    <?php if($model->not_punch_interval){$type = '上午';}else{$type = '下午';} 
          $user_id = $model -> user_id;
          $username = User::find()->where(['id' => $user_id])->one()->username;
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'full_time',
            // 'user_id',
             ['attribute' => 'user_id','value' => $username],
            'not_punch_time',
            // 'not_punch_interval',
            ['attribute' => 'not_punch_interval','value' => $type],
            'not_punch_reason:ntext',
            'depart_opinion:ntext',
            'manager_opinion:ntext',
        ],
    ]) ?>

</div>
