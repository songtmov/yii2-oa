<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Region;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .linkage .col-xs-4{
        padding: 0;
    }
    .linkage .col-xs-4 .col-md-10{
        padding: 0 5px;
    }
</style>
<div class="store-form mt">
<!--$form = ActiveForm::begin(); ?>-->
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
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <label class="col-md-2 col-xs-2 control-label" for="store-province">所在地区</label>
    <div class="col-xs-10 linkage">
        <div class="col-xs-4">
            <?= $form->field($model, 'province')->dropDownList(
                ArrayHelper::map($region, 'id', 'name'),
                [
                    'prompt'=> Yii::t('common','Please Select'),
                    'onchange'=> '
                            $.ajax({
                                type: "POST",
                                url: "' . Url::to(['ajax-list-show']) . '",
                                data: {id:$(this).val()},
                                success: function( data ){
                                    $( "select#store-city" ).html( data );
                                }
                            });'
                ])->label(false);?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'city')->dropDownList(
                [],
                [
                    'prompt'=> Yii::t('common','Please Select'),
                    'onchange'=> '
                            $.ajax({
                                type: "POST",
                                url: "' . Url::to(['ajax-list-show']) . '",
                                data: {id:$(this).val()},
                                success: function( data ){
                                    $( "select#store-area" ).html( data );
                                }
                            });'
                ])->label(false);?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'area')->dropDownList(
                [],
                [
                    'prompt'=> Yii::t('common','Please Select'),
                ]
            )->label(false) ?>
        </div>
    </div>
    
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Store_image')->textInput(['type'=>'hidden','value' => 'default'])->label(false) ?>
    
    <?= $form->field($model, 'acreage')->textInput()->label('医院面积') ?>
    
    <?= $form->field($model, 'head_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['status'=>10])->all(),'id','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择店长……'],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);?>
    
    <?= $form->field($model, 'contact_number')->textInput(['maxlength' => true])->label('医院电话') ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">成立时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'Store[store_created_time]',
        'value'=>$model->isNewRecord ?'':date('Y-m-d',$model->store_created_time),
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
