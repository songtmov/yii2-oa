<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Region;
use common\models\Store;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Cstore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cstore-form mt">
    
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
    
    <?= $form->field($model, 'store_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>
    
    <!-- <?//= $form->field($model, 'hospital')->textInput(['maxlength' => true]) ?> -->
    
    <!-- <?//= $form->field($model, 'hospital')->dropDownList([],['prompt'=> Yii::t('common','Please Select')])?> -->
    
    <?= $form->field($model, 'hospital')->widget(Select2::classname(), [
        // 'data' => \yii\helpers\ArrayHelper::map(\common\models\Store::find()->where()->all(),'id','name'),
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Store::find()->all(),'id','name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择医院……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <!-- <?//= $form->field($model, 'create_time')->textInput() ?> -->
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">预约时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'Cstore[create_time]',
        'value'=>$model->isNewRecord ?'':$model->create_time,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'acreage')->textInput() ?>
    
    <?= $form->field($model, 'store_photo')->textInput(['type' => 'hidden','value' =>'common\widgets\file_upload\FileUpload'])->label(false) ?>
    
    <?= $form->field($model, 'boss')->textInput(['maxlength' => true]) ?>
    
    <?php  $d_id = \common\models\Department::find()->select('id')->where(['name' => '市场部'])->one()['id'];?>

    <?= $form->field($model, 'business')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['department_id'=>$d_id])->all(),'id','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择业务……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'encamp')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'consultation')->textInput(['maxlength' => true]) ?>
    
    <!-- <?//= $form->field($model, 'business')->textInput(['maxlength' => true]) ?> -->
    
    <div class="form-group button-center">

        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

     <?= $form->field($model, 'create_time')->textInput(['type' => 'hidden','value' => date('Y-m-d h:i:s',time()),'maxlength' => true])->label(false) ?>
    
    <?php ActiveForm::end(); ?>
    
</div>