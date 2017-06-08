<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\select2;

?>

<script src="https://cdn.bootcss.com/vue-resource/1.3.1/vue-resource.common.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/vue/2.3.3/vue.min.js"></script>
<script src="https://cdn.bootcss.com/store.js/1.3.20/store.min.js"></script>

<div class="photos-form mt">
    
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
            'class' => 'form-horizontal',
        ],
        'fieldConfig' => [
            'template' => "
                            {label}
                            <div class='col-md-10 col-xs-9'>{input}</div>
                            <div class='col-xs-10 col-xs-offset-2'>{error}</div>
                            ",
            'labelOptions' => ['class' => 'col-md-2 col-xs-2 control-label'],]
    ]); ?>
    
    <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'id','client_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择用户名……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <input id="button" type="button" v-bind:value="msg" style="position: relative;top:-4em;left: 45em;" v-on:click='doThis' >
    
    <?= $form->field($model, 'billing_id')->dropDownList([],['prompt' => '请选择手术订单...', 'v-bind:disabled'=>'true']) ?>
    
    <?= $form->field($model, 'photo_type')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\PhotoType::find()->all(),'id','name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择类型……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <?= $form->field($model, 'photo_name')->textInput(['maxlength' => true,'placeholder'=> '图片名称最大不超15个字']) ?>
    
     <?= $form->field($model, 'remark')->textInput(['maxlength' => true,'placeholder' => '标记最大不得超过50个字']) ?>
    
    <?= $form->field($model,'path')->widget('common\widgets\file_upload\FileUpload')->label('上传图片')?>
    
    <div class="form-group button-center">
        
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
        
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>
<script type="text/javascript">
    var vm = new Vue({
      el: 'input#button',
      data:{
            msg:'检测'
      },
      methods:{
        doThis:function(){
             var username = $('span#select2-photos-customer_id-container').attr('title');
             var start = $('select#photos-billing_id').children("option:eq(0)").text();
             
             store.set('old', { name:username, likes:start }) 
             
             if(~(start == '请选择手术订单...')){
                $('select#photos-billing_id').attr('disabled',false);
             }

             this.msg = '重新检测',
             $.ajax({
                'url':'/photos/ajax',
                dataType:'Json',
                type:'post',
                data:{username},
                async:true,
                success:function(res){
                    var string = '';
                    for (var i = res.length - 1; i >= 0; i--) {
                        string += '<option value="'+ res[i]+'">'+res[i]+'</option>';
                    }
                    $('select#photos-billing_id').html(string);
                },
                error:function(){
                    alert('你还没有选择用户名！！');
                }
             });
        }
      }
    }); 
    var onlyone = new Vue({
        el:'select#photos-billing_id',
        data:{
            disabled:true,
        },
    });
</script>