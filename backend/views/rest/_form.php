<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Rest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rest-form mt">

    <?php $form = ActiveForm::begin([
        
        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "
                            {label}
                            <div class='col-md-10 col-xs-9'>{input}</div>
                            <div class='col-xs-10 col-xs-offset-2'>{error}</div>
                            ",
            'labelOptions' => ['class' => 'col-md-2 col-xs-2 control-label'],]
    ]); ?>
    

    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">调休开始时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';

    echo DateRangePicker::widget([
        'name'=>'Rest[rest_start_time]',
        'value'=>$model->isNewRecord ?'':$model->rest_start_time,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">调休结束时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';

    echo DateRangePicker::widget([
        'name'=>'Rest[rest_over_time]',
        'value'=>$model->isNewRecord ?'':$model->rest_over_time,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'department_opinion')->textarea(['rows' => 6]) ?>
    
    <!-- <?//= $form->field($model, 'd_o_time')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'manager_opinion')->textarea(['rows' => 6]) ?>

    <!-- <?//= $form->field($model, 'm_o_time')->textInput(['maxlength' => true]) ?> -->
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true,'type' => 'hidden','value' => $_SESSION['__id']])->label(false) ?>

    <?= $form->field($model, 'full_time')->textInput(['maxlength' => true,'value' => time(),'type' => 'hidden'])->label(false) ?>
    
    <?php ActiveForm::end(); ?>

</div>
