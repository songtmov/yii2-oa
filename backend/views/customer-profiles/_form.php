<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model common\models\CustomerProfiles */
/* @var $form yii\widgets\ActiveForm */

// P($all);die;
?>

<?=HTML::jsFile('@web/statics/js/jquery.js') ?>

<div class="customer-profiles-form mt">

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

    <!-- <?//= $form->field($model, 'customer_id')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
        // 'data' => \yii\helpers\ArrayHelper::map(\common\models\Store::find()->where()->all(),'id','name'),
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'id','client_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择客户名……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <input type="button" class="btn btn-success" id="jc" style="position: absolute;left: 100%;top:5%;" value="检查">

    <!-- <script type="text/javascript">
        $(function(){
            $('input[class="select2-search__field"]').blur(function(){
                alert($this);
            });
        });
    </script> -->

    <!-- <?
    // = $form->field($model, 'billing_id')->widget(Select2::classname(), [
    //     'data' => \yii\helpers\ArrayHelper::map(\common\models\BillingOperation::find()->all(),'id','order_num'),
    //     'language' => 'zh-CN',
    //     'options' => ['placeholder' => '请选择手术订单……'],
    //     'pluginOptions' => [
    //         'allowClear' => true
    //     ],
    ]);?> -->
    
    <!-- <?//= $form->field($model, 'billing_id')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'billing_id')->dropDownList(['0' => 1,],['prompt'=>'上方检测，可查看手术订单...','disabled'=>'disabled']) ?>
    
    <script type="text/javascript">
        $(function(){
            $('input[id="jc"]').click(function(){
                var title = $('span[id="select2-customerprofiles-customer_id-container"]').attr('title');
                $.ajax({
                  type: 'post',
                  url: "/customer-profiles/jc",
                  async: false,
                  data: {title},
                  success: function(res){
                    if(res == 1){
                       alert('该用户没有手术订单！');
                    }else{
                        $("select#customerprofiles-billing_id").removeAttr('disabled');
                        $("select#customerprofiles-billing_id").html(res);
                    }
                  }
                });
            });
        });
    </script>
    
    <?= $form->field($model, 'surger_date')->textInput(['disabled' => 'disabled','value'=>'','placeholder'=>'选择手术订单后自动获取...']) ?>
    
    <?= $form->field($model, 'starting_time')->textInput(['disabled' => 'disabled','value'=>'','placeholder'=>'选择手术订单后自动获取...']) ?>
    
    <?= $form->field($model, 'finishing_time')->textInput(['disabled' => 'disabled','value'=>'','placeholder'=>'选择手术订单后自动获取...']) ?>
    
    <script type="text/javascript">
            $(function(){
                $('select#customerprofiles-billing_id').blur(function(){
                    var now = $(this).val();
                    $.ajax({
                      type: 'post',
                      url: "/customer-profiles/order",
                      async: false,
                      data: {now},
                      success: function(res){
                        var data = $.parseJSON(res);
                        var time = data.time;
                        var time_start = data.time_start;
                        var time_end = data.time_end;
                        $('input#customerprofiles-surger_date').attr('value',time);
                        $('input#customerprofiles-starting_time').attr('value',time_start);
                        $('input#customerprofiles-finishing_time').attr('value',time_end);
                      }
                    });
                });
            });
    </script>
    
    <?= $form->field($model, 'dignosis_before')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'type_of_anesthesia')->dropDownList([ '全麻' => '全麻', '局部' => '局部', ], ['prompt' => '请选择麻醉方式...']) ?>
    
    <?= $form->field($model, 'anesesiologistID')->dropDownList($all,['prompt' => '请选择麻醉医师...']) ?>
    
    <?= $form->field($model, 'is_clear')->radioList(['0' => '是','1' => '否']) ?>
    
    <?= $form->field($model, 'change_clothes')->radioList(['0' => '是','1' => '否']) ?>
    
    <?= $form->field($model, 'skin_preparation')->radioList(['0' => '是','1' => '否']) ?>

    <?= $form->field($model, 'remove_jewelry')->radioList(['0' => '是','1' => '否'])  ?>

    <?= $form->field($model, 'pathway')->radioList(['0' => '是','1' => '否']) ?>

    <?= $form->field($model, 'medicine_name')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'medicine_specification')->textInput(['maxlength' => true]) ?> -->

   <!--  <?//= $form->field($model, 'transfusion_time')->textInput() ?> -->

    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">输液时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'CustomerProfiles[transfusion_time]',
        'value'=>$model->isNewRecord ?'':$model->transfusion_time,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>

    <?= $form->field($model, 'nuresID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hepatitis_B')->radioList(['0'=>'正常','1' => '携带者']) ?>

    <?= $form->field($model, 'hepatitis_C')->radioList(['0'=>'正常','1' => '携带者']) ?>

    <?= $form->field($model, 'AIDS')->radioList(['0'=>'正常','1' => '携带者']) ?>

    <?= $form->field($model, 'syphilis')->radioList(['0'=>'正常','1' => '携带者']) ?>
    
    <!-- <?//= $form->field($model, 'hepatitis_C')->radioList() ?> -->
    
    <!-- <?//= $form->field($model, 'AIDS')->textInput() ?> -->

    <!-- <?//= $form->field($model, 'syphilis')->textInput() ?> -->

    <?= $form->field($model, 'blood_sugar')->textInput(['placeholder'=>'请输入血糖数值（单位mmol/L）...']) ?>

    <!-- <?//= $form->field($model, 'create_time')->textInput() ?> -->
    
     <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">护理时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    echo DateRangePicker::widget([
        'name'=>'CustomerProfiles[create_time]',
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

    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
