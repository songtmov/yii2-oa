<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfiles */

$this->title = $name.'的手术档案';
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','档案列表'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $name;
?>
<div class="customer-profiles-view">
    
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
            // 'customer_id',
            'billing_id',
            // 'surger_date',
            // 'starting_time',
            // 'finishing_time',
            'dignosis_before',
            'type_of_anesthesia',
            // 'anesesiologistID',
            [
                'attribute' => 'is_clear',
                'value' => $name
            ],
            // 'is_clear',
            [
                'attribute' => 'is_clear',
                'value' => \common\models\CustomerProfiles::$yn[$model->is_clear]
            ],[
                'attribute' => 'change_clothes',
                'value' => \common\models\CustomerProfiles::$yn[$model->change_clothes]
            ],[
                'attribute' => 'skin_preparation',
                'value' => \common\models\CustomerProfiles::$yn[$model->skin_preparation]
            ],[
                'attribute' => 'remove_jewelry',
                'value' => \common\models\CustomerProfiles::$yn[$model->remove_jewelry]
            ],[
                'attribute' => 'pathway',
                'value' => \common\models\CustomerProfiles::$yn[$model->pathway]
            ],
            'medicine_name',
            'medicine_specification',
            'transfusion_time',
            'nuresID',
            [
                'attribute' => 'hepatitis_B',
                'value' => \common\models\CustomerProfiles::$bring[$model->hepatitis_B]
            ],[
                'attribute' => 'hepatitis_C',
                'value' => \common\models\CustomerProfiles::$bring[$model->hepatitis_C]
            ],[
                'attribute' => 'AIDS',
                'value' => \common\models\CustomerProfiles::$bring[$model->AIDS]
            ],[
                'attribute' => 'syphilis',
                'value' => \common\models\CustomerProfiles::$bring[$model->syphilis]
            ],[
                'attribute' => 'blood_sugar',
                'value' => $model->blood_sugar.'（mmoL/h）'
            ],
            // 'blood_sugar',
            'create_time',
        ],
    ]) ?>

</div>
