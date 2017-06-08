<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Customer;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #customer-source label,#customer-sex label{
        margin-right: 15px;
    }
</style>
<div class="customer-form mt">
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

    <?= $form->field($model, 'client_name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true,'value'=>Yii::$app->request->get('telephone')]) ?>
    
    <?= $form->field($model, 'member_card')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'age')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'sex')->radioList([0=>'女',1=>'男']) ?>
    
    <!-- <?//= $form->field($model, 'source')->dropDownList(Customer::$static,['prompt'=>'请选择来源渠道……']) ?> -->

    <?= $form->field($model, 'source')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\SourceType::find()->all(),'id','source_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择来源渠道……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('来源渠道');?>
    
    <?= $form->field($model, 'cstore_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Cstore::find()->all(),'id','store_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择美容院……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('美容院');?>

    <div id="Sale">

        <?=$form->field($model, 'sale_id')->dropDownList(
            \yii\helpers\ArrayHelper::map($sale,'id','username'),
            ['prompt'=>'请选择销售员……']
        ) ?>

    </div>
    <!-- service_id -->
    
    <?= $form->field($model, 'service_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\UserModel::find()->where(['department_id'=>12])->all(),'id','username'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择咨询师……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('咨询师');?>
    
    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','id'=>'aaaa']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

<?php
$this->registerJs('
        $(document).ready(function(){
            $("#customer-source label").on("click",function(){
                alert(111);
            });
            $("#customer-source").change(function(){
                var source = $("#customer-source").val();
                if(source == 3){
                    $("#Sale").css("display","block");
                }else{
                    $("#Sale").css("display","none");
                }

            });
            $("#aaaa").on("click",function(){
                var display = $("#Sale").css("display");
                var sale = $("#customer-sale_id").val();

                if(display == "block" && sale == ""){
                    $("#Sale div").addClass("has-error");
                    $("#Sale div").removeClass("has-success");
                    $("#Sale .help-block").html("请选择销售人员。");
                    //$("#target").toggleClass("newClass")
                    //如果ID为“target”的元素已经定义了CSS样式，它将被移除；
                    //反之，CSS类”newClass“将被赋给该ID。
                    return false;

                }else{
                    $("#Sale div").addClass("has-success");
                    $("#Sale div").removeClass("has-error");
                }

            });
        });
');

?>