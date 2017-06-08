<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\RecordNursing */
/* @var $form yii\widgets\ActiveForm */
?>

<?=HTML::jsFile('@web/statics/js/jquery.js') ?>

<div class="record-nursing-form mt">

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

        <?php if(!isset($_GET['billing_id'])){
            $_GET['billing_id'] = '';
        } ?>

        <!-- <?php 
        // if(!isset($_GET['client_name'])){
            // $_GET['billing_id'] = '';
        //} ?> -->
    
     <?php

     if(isset($_GET['client_name'])){
        echo $form->field($model, 'customer_id')->dropDownList([$_GET['client_name']=>$_GET['name']],['disabled'=>'disabled','selected' => 'selected']);
       echo '<input type="hidden" name="RecordNursing[customer_id]" value="'.$_GET['client_name'].'">';

     }else{

            echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'id','client_name'),
            'language' => 'zh-CN',
            'options' => ['placeholder' => '请选择客户名……'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label('顾客名');
            echo "<input type='button' id='customer' class='btn btn-success' style='position: absolute;left:100%;top:12%;' value='检测'>";
     }
    ?>
    
    <!-- <?
    // = $form->field($model, 'customer_id')->widget(Select2::classname(), [
    //     'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'id','client_name'),
    //     'language' => 'zh-CN',
    //     'options' => ['placeholder' => '请选择客户名……'],
    //     'pluginOptions' => [
    //         'allowClear' => true
    //     ],
    // ]);
    ?> -->

     <?php
        if(!empty($_GET['billing_id'])){
            echo $form->field($model, 'customer_profiles_id')->textInput(['maxlength' => true,'value' => $_GET['billing_id'],'disabled'=>'disabled'])->label('手术档案号');
            echo '<input type="hidden" name="RecordNursing[customer_profiles_id]" value="'.$_GET['billing_id'].'">';
        }else{

            echo $form->field($model, 'customer_profiles_id')->dropDownList([],['prompt' => '上方检测后可见...','disabled' => 'disabled'])->label('手术档案号');
        }
        
     ?>
    
    <script type="text/javascript">
        $(function(){
            $('input#customer').click(function(){
                var title = $('span#select2-recordnursing-customer_id-container').attr('title');
               $.ajax({
                  type: 'post',
                  url: "/customer-profiles/jc",
                  async: false,
                  data: {title},
                  success: function(res){
                    if(res == 1){
                       $("select#recordnursing-customer_profiles_id").attr('disabled','disabled');
                       $("select#recordnursing-customer_profiles_id").attr('value','');
                       $("select#recordnursing-customer_profiles_id").children().remove();
                       $("select#recordnursing-customer_profiles_id").attr('placeholder','上方检测后可见...');
                       alert('该用户没有手术订单！');
                    }else{
                        $("select#recordnursing-customer_profiles_id").removeAttr('disabled');
                        $("select#recordnursing-customer_profiles_id").html(res);
                    }
                  }
                });
            });
        });
    </script>

    <!--  <?
    //  = $form->field($model, 'customer_profiles_id')->widget(Select2::classname(), [
    //     'data' => \yii\helpers\ArrayHelper::map(\common\models\CustomerProfiles::find()->all(),'id','id'),
    //     'language' => 'zh-CN',
    //     'options' => ['placeholder' => '请选择美容院……'],
    //     'pluginOptions' => [
    //         'allowClear' => true
    //     ],
    // ])->label('档案号');
    ?> -->
    
    <!-- <?//= $form->field($model, 'record_date')->textInput() ?> -->

    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">护理时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    
    echo DateRangePicker::widget([
        'name'=>'RecordNursing[record_date]',
        'value'=>$model->isNewRecord ?'':$model->record_date,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);

    echo '</div></div>';
    ?>

    <!-- <?//= $form->field($model, 'record_time')->textInput() ?> -->

    <?= $form->field($model, 'record_time')->widget('kartik\daterange\DateRangePicker',[
            'convertFormat'=>true,
            'pluginOptions'=>[
                'timePicker'=>true,
                'timePickerIncrement'=>1,
                'locale'=>['format'=>'Y-m-d H:i:s']
            ]
        ]);
    ?>
    
    <?= $form->field($model, 'body_tempreture')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'blood_pressure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pulse')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'heart_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nurse_id')->dropDownList($nurse,['prompt'=>'请选择护士...'])->label('护士') ?>
   
    <!-- <?//= $form->field($model, 'create_time')->textInput() ?> -->
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
