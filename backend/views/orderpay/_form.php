<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\OrderPay */
/* @var $form yii\widgets\ActiveForm */
?>
<?=Html::jsFile('@web/statics/js/jquery.js')?>
<style>
    #order{
        position: absolute;
        top: 12.8%;
        left: 100%;
    }
</style>
<div class="order-pay-form mt">

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
    
    <!-- <?//= $form->field($model, 'billing_id')->textInput() ?> -->
    
    <?= $form->field($model, 'billing_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BillingOperation::find()->all(),'order_num','order_num'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请输入手术订单号……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('手术订单');?>
    
     <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">未交款项</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, '', ['class' => 'form-control','disabled'=>"value",'id' => 'moeny']);
        echo '</div></div>';
    ?>
    <!-- <button type = "button" style="height: 5%;" id = "order" class="btn btn-success">检查余款</button> -->
    <input type="button" class="btn btn-success" style="height: 5%;" id = "order" value="检查余款">
    <script type="text/javascript">
        $('#order').click(function(){
            var num = $('#select2-orderpay-billing_id-container').attr('title');
            $.ajax({
              type: 'post',
              url: "/orderpay/create",
              async: false,
              data: {num},
              success: function(html){
                $("#moeny").attr('value',html);
              }
            });
        });
        // not_most_satisfied. glyphicon glyphicon-earphone
        $(function(){
            $('#orderpay-sum_money').blur(function(){
                var now = $(this).val();
                var old = $('#moeny').val();
                if(now > old){
                    alert('⚠️填写有误！实收金额大于未交款项！');
                }
            });
        });
    </script>
    
    <?= $form->field($model, 'isall')->dropDownList([ '0' => '是', '1' => '否'], ['prompt' => '请选择...']) ?>
    
    <!-- <?//= $form->field($model, 'isall')->textInput() ?> -->
    
    <?= $form->field($model, 'sum_money')->textInput(['maxlength' => true,'placeholder' => '单位为*元']) ?>
    
    <?= $form->field($model, 'payment_method')->dropDownList([ '0' => '现金', '1' => '刷卡', '2' => '转帐'], ['prompt' => '请选择...'])->label('收款方式') ?>
    
    <?= $form->field($model, 'nbackup')->textarea(['rows' => 6]) ?>
    
    <!-- <?//= $form->field($model, 'user_id')->textInput() ?> -->

    <?= $form->field($model, 'user_id')->textInput(['value' => yii::$app->user->id,'type' => 'hidden'])->label(false) ?>

    <?php date_default_timezone_set('PRC');?>

    <?= $form->field($model, 'sub_time')->textInput(['value' => date('Y-m-d h:i:s',time()),'type' => 'hidden'])->label(false) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
