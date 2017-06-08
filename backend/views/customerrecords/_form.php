<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerRecords */
/* @var $form yii\widgets\ActiveForm */
?>

<?=Html::jsFile('@web/statics/js/jquery.js')?>
<style>
    #order{
        position: absolute;
        top: 8%;
        left: 100%;

    }
</style>
<div class="customer-records-form mt">

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
    
    <!-- <?//= $form->field($model, 'service_id')->textInput() ?> -->
    
    <?= $form->field($model, 'service_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BillingOperation::find()->all(),'order_num','order_num'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请输入手术订单号……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('手术订单');?>
    
    <input type="button" class="btn btn-success" style="height: 5%;" id = "order" value="检查">
    
    <?= $form->field($model, 'pay')->textInput(['maxlength' => true,'placeholder' => '可通过以上检查按钮自动查看订单金额','id' => 'moeny']) ?>
    
    <script type="text/javascript">
        $(function(){
            $('#order').click(function(){
                var num = $('#select2-customerrecords-service_id-container').attr('title');
                $.ajax({
                  type: 'post',
                  url: "/customerrecords/ajax",
                  async: false,
                  data: {num},
                  success: function(html){
                    $("#moeny").attr('value',html);
                  },
                  error:function(){
                    alert('您还未选择手术订单号');
                  }
                });
            });
        });
    </script>

    <?= $form->field($model, 'visited_problem')->textInput(['maxlength' => true]) ?>
    
    <?php 
    echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">术后康复时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'CustomerRecords[after_time]',
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
    
    <?php 
    // echo '<div class="form-group field-position-found_time required">
    //     <label class="col-md-2 col-xs-2 control-label" for="position-found_time">回访时间</label>
    //     <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    // echo DateRangePicker::widget([
    //     'name'=>'CustomerRecords[visited_time]',
    //     'value'=>$model->isNewRecord ?'':date('Y-m-d',$model->store_created_time),
    //     'useWithAddon'=>true,
    //     'pluginOptions'=>[
    //         'class'=>'form-control',
    //         'singleDatePicker'=>true,
    //         'showDropdowns'=>true
    //     ]
    // ]);
    // echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'operating_position')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'visited_mode')->dropDownList([ '0'=>'手机电话', '1'=>'面谈', '2'=>'QQ微信', '3'=>'其他' ], ['prompt' => '请选择回访方式...']) ?>

    <?= $form->field($model, 'visited_content')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'bed_position')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ishealthy')->dropDownList(['0' => '很好','1'=>'一般','2' => '较差'],['prompt' => '请选择...'])->label('健康状态') ?>
    
    <?= $form->field($model, 'customer_detail')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php date_default_timezone_set('PRC');?>
    
    <?= $form->field($model, 'visited_time')->textInput(['type' => 'hidden','value' => date('Y-m-d H:i:s',time())])->label(false) ?>
    
    <?= $form->field($model, 'visited_id')->textInput(['type'=>'hidden','value' => $_SESSION['__id']])->label(false) ?>

    <?php ActiveForm::end(); ?>

</div>
