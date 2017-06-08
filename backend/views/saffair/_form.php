<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use common\models\Region;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
// use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\saffair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saffair-form mt">

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
    
    <!-- <?//= $form->field($model, 'customer')->textInput(['maxlength' => true]) ?> -->
    
    <?= $form->field($model, 'customer')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'client_name','client_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请输入客户名...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('客户名称');?>

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
                                    $( "select#saffair-city" ).html( data );
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
                                    $( "select#saffair-area" ).html( data );
                                }
                            });' 
                ])->label(false);?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'area')->dropDownList(
                [],
                [
                    'prompt'=> Yii::t('common','Please Select'),
                    'onchange'=> '
                            $.ajax({
                                type: "POST",
                                url: "' . Url::to(['hospital']) . '",
                                data: {id:$(this).val()},
                                success: function( data ){
                                    $( "select#saffair-hospital" ).html( data );
                                }
                            });'
                ]
            )->label(false) ?>
        </div>
    </div>

    <!-- <?//= $form->field($model, 'hospital')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'hospital')->dropDownList([],[
        'prompt'=> Yii::t('common','Please Select'),
        'onchange'=> '
        $.ajax({
            type: "POST",
            url: "' . Url::to(['doctor']) . '",
            data: {id:$(this).val()},
            success: function( data ){
                $( "select#saffair-doctor" ).html( data );
            }
        });'
    ])?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">预约时间</label>
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
    
    <!-- <?//= $form->field($model, 'appointment_type')->textInput() ?> -->
    
    <?= $form->field($model, 'appointment_type')->dropDownList([1=>'内部会议',0=>'外部会议'],[
        'prompt'=>'请选择状态……'
    ]) ?>
    
    <!-- <?//= $form->field($model, 'head_id')->widget(Select2::classname(), [
        // 'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->where(['status'=>10])->all(),'id','username'),
        // 'language' => 'zh-CN',
        // 'options' => ['placeholder' => '请选择店长……'],
        // 'pluginOptions' => [
        //     'allowClear' => true
        // ],
    //]);?> -->
    
    <?= $form->field($model, 'doctor')->dropDownList([],[
        'prompt'=> Yii::t('common','Please Select'),
    ])?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
