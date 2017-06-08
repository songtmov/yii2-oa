<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Evection */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('
        .field-evection-province .col-xs-offset-2, .field-evection-city .col-xs-offset-2 {
        margin-left: 0;
        width:100%;
    }
    .field-evection-province .col-md-10,.field-evection-city .col-md-10{
        width:100%
    }
    .City>.col-md-6:nth-child(1){
        padding-right:5px
    } 
    .City>.col-md-6:nth-child(2){
        padding-left:5px
    } 
   
    ');
?>


<div class="evection-form mt">
    
    <?php $form = ActiveForm::begin([

        'options' => [
            'class' => 'form-horizontal'
        ],
        'fieldConfig' => [
            'template' => "
                            {label}
                            <div class='col-md-10 col-xs-10'>{input}</div>
                            <div class='col-xs-10 col-xs-offset-2'>{error}</div>
                            ",
            'labelOptions' => ['class' => 'col-md-2 col-xs-2 control-label'],]
    ]); ?>
    <div class="row">
        <label class="col-md-2 col-xs-2 control-label" for="evection-province">出差地点</label>
        <div class="col-md-10 col-xs-10">
            <div class="row City">
                <div class="col-md-6 col-xs-6">
                    <?= $form->field($model, 'province')->dropDownList( ArrayHelper::map($region, 'id', 'name'),[
                    'prompt'=>'请选择',
                    'onchange'=> '
                            $.ajax({
                                type: "POST",
                                url: "' . Url::to(['/store/ajax-list-show']) . '",
                                data: {id:$(this).val()},
                                success: function( data ){
                                    $( "select#evection-city" ).html( data );
                                }
                            });'
                    ])->label(false) ?>
                </div>
                <div class="col-md-6 col-xs-6">
                    <?= $form->field($model, 'city')->dropDownList([], ['prompt'=>'请选择'])->label(false) ?>
                </div>
            </div>
                
        </div>  

    </div>
       
    <?= $form->field($model, 'evection_time')->widget('kartik\daterange\DateRangePicker',[
                'convertFormat'=>true,
                'pluginOptions'=>[
                    'timePicker'=>true,
                    'timePickerIncrement'=>1,
                    'locale'=>['format'=>'Y-m-d H:i:s']
                ]
            ]);
    ?>

    <?= $form->field($model, 'evection_reason')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'evection_info')->textArea(['maxlength' => true,'rows'=>6]) ?>

    <div class="form-group button-center">
        
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    
    </div>

    <?= $form->field($model, 'evection_img')->textInput(['type' => 'hidden','value'=>'common\widgets\file_upload\FileUpload'])->label(false) ?>
    
    <?php ActiveForm::end(); ?>

</div>
