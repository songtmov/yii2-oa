<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

// p($cate_id);die;
/* @var $this yii\web\View */
/* @var $model common\models\OutboundOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<?=HTML::JsFile('@web/statics/jquery.js')?>

<div class="outbound-order-form mt">
    
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
    
    <?= $form->field($model, 'cate_id')->dropDownList($cate_id,['prompt' => '请选择类别...'])->label('类别选择') ?>
    
    <script type="text/javascript">
        $(function(){
            $('#outboundorder-cate_id').blur(function(){
                var cate = $(this).val();
                $.ajax({
                  type: 'post',
                  url: "/outboundorder/create",
                  async: false,
                  data: {cate},
                  success: function(res){
                    $("select#outboundorder-item_id").html(res);
                  }
                });
            });
            
            $('#outboundorder-item_id').blur(function(){
                var item = $(this).val();
                $.ajax({
                  type: 'post',
                  url: "/outboundorder/stock",
                  async: false,
                  data: {item},
                  success: function(back){
                    $("select#item").html(back);
                  }
                });
            });
        })
    </script>
    
    <?= $form->field($model, 'item_id')->dropDownList([],['prompt' => '请选择物品...'])->label('物品选择') ?>
    
    <?= $form->field($model, 'item_id')->dropDownList([],['prompt' => '请选择明细...','id' => 'item','display'=>'none'])->label('明细选择') ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">剩余库存</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        echo Html::input('text', false, '', ['class' => 'form-control','disabled'=>"value",'id' => 'k','value' => '0']);
        echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'numbers')->textInput(['placeholder' => '出库数量单位-个']) ?>
    
    <?= $form->field($model, 'nbackup')->textarea(['rows' => 6]) ?>
    
    <script type="text/javascript">
        $(function(){
            $('#item').blur(function(){
                var item = $(this).val();
                $.ajax({
                  type: 'post',
                  url: "/outboundorder/inventory",
                  async: false,
                  data: {item},
                  success: function(back){
                    $("input#k").attr('value',back);
                  }
                });
            });

            $('#outboundorder-numbers').blur(function(){
                var stock = $(this).val();
                var k = $('input#k').val();
                if(stock > k){
                    var y = stock - k;
                    alert('出库数量大于剩余数量！>' + y );
                }
            });
        });
    </script>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
