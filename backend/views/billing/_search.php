<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BillingOperation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billing-operation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "
                            {label}
                            <div class='col-md-9 col-xs-9'>{input}</div>
                            <div class='col-xs-9 col-xs-offset-3'>{error}</div>
                            ",
            'labelOptions' => ['class' => 'col-md-3 col-xs-3 control-label'],]

    ]); ?>
    <div class="row">
        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'client_id') ?>

        </div>

        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'surgical_id') ?>

        </div>
        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'search')->label('员工姓名') ?>

        </div>
        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'surgery_cost') ?>

        </div>
        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'store_id') ?>

        </div>
        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'status')->dropDownList(\common\models\BillingOperation::$state,['prompt'=>'请选择']) ?>
        
        </div>
        <div class="col-md-3 col-lg-2">

            <?= $form->field($model, 'created_time')->widget('kartik\daterange\DateRangePicker',[
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'timePicker'=>true,
                    'timePickerIncrement'=>1,
                    'locale'=>['format'=>'Y-m-d H:i:s']
                ]
            ]);

            ?>

        </div>
        <div class="col-md-3 col-lg-2">
            <div class="form-group">
                <?= Html::submitButton('立即搜索', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
