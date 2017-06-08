<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Check */
/* @var $form yii\widgets\ActiveForm */
?>

<?=HTML::JsFile('@web/statics/jquery.js')?>

<div class="check-form mt">
    
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
    
    <?= $form->field($model, 'cate_id')->dropDownList($cate_id,['prompt' => '请选择类别...'])->label('类别选择') ?>
    
    <script type="text/javascript">
        $(function(){
            $('#check-cate_id').blur(function(){
                var cate = $(this).val();
                $.ajax({
                  type: 'post',
                  url: "/outboundorder/create",
                  async: false,
                  data: {cate},
                  success: function(res){
                    $("select#check-item_id").html(res);
                  }
                });
            });

            $('#check-item_id').blur(function(){
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
    
    <?= $form->field($model, 'paper_num')->textInput(['disabled' => 'disabled']) ?>
    
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
                    $("input#check-paper_num").attr('value',back);
                  }
                });
            });
        });
    </script>
    
    <?= $form->field($model, 'actual_num')->textInput() ?>
    
    <?= $form->field($model, 'deviation')->textInput(['value' => '']) ?>
    
    <?= $form->field($model, 'deviation_reason')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>
   
    <?= $form->field($model, 'user_id')->textInput(['value'=>yii::$app->user->id,'type'=>'hidden'])->label(false) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $('#check-actual_num').blur(function(){

        var t = $(this).val();

        var f = $('input#check-paper_num').val();

        var end = t - f;

        $('input#check-deviation').attr('value',end);
        
    });
</script>
