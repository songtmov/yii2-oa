<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\MeetingConvey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-convey-form mt">

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
    
    <?= $form->field($model, 'meeting_type')->dropDownList(['小会' => '小会','大会' => '大会'],['prompt'=>'选择会议类型...']) ?>
    
    <?= $form->field($model, 'cstore_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Cstore::find()->all(),'store_name','store_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'training_date')->textInput() ?> -->
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">培训时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'MeetingConvey[training_date]',
        'value'=>$model->isNewRecord ?'':$model->training_date,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <!-- <?//= $form->field($model, 'doctor_id')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'doctor_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['position_id' => '6'])->all(),'username','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'asistant_id')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'asistant_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['position_id' => '7'])->all(),'username','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'nurse_id')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'nurse_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['position_id' => '8'])->all(),'username','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'resident_id')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'resident_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['position_id' => '31'])->all(),'username','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'host_id')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'host_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['position_id' => '47'])->all(),'username','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'consultant_id')->textInput(['maxlength' => true]) ?> -->
    <?= $form->field($model, 'consultant_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['position_id' => '30'])->all(),'username','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'creattime')->textInput() ?> -->
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">完成会议传达时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'MeetingConvey[creattime]',
        'value'=>$model->isNewRecord ?'':$model->creattime,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'meeting_topic')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'meeting_address')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'cstore_address')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'owner_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'owner_phone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'cstore_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cstore_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manager_phone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'emplyees_number')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'hotel_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'hotel_address')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'hotel_floor')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'instructor_id')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'engineer_id')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'cameraman_id')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'ticket')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'draw')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'invitation')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'box')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'vehicle_type')->dropDownList([ '租赁' => '租赁', '商务' => '商务', '越野' => '越野', ], ['prompt' => '选择车辆种类...']) ?>
    
    <?= $form->field($model, 'renter_id')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'marketing_responsible_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'meeting_responsible_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ko_solution')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'place_solution')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'travel_arrangement')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'comment')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
