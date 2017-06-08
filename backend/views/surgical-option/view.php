<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\SurgicalOption */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','方式列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surgical-option-view">

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
            'option_name',
        ],
    ]) ?>

</div>
