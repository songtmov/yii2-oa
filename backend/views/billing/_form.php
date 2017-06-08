<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

// public $enableCsrfValidation = false;

/* @var $this yii\web\View */
/* @var $model common\models\BillingOperation */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('
    .input-group-lg .help-block{
        margin:0;
       display:none
    }
    .col-md-7{
        padding:0
    }
    .billing-operation-form {
        margin-top:20px
    }
');
?>

<div class="customer-search mt">

    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'method' => 'get',
    ]); ?>
    
    <div class="col-md-7 col-md-offset-2" style="padding: 0">

        <div class="input-group input-group-lg">

            <?= $form->field($query, 'telephone')->textInput(['placeholder'=>empty($_GET['Search']['telephone'])?'请输入手机号码进行查询……':$_GET['Search']['telephone'],'class'=>'form-control input-lg'])->label(false) ?>

            <span class="input-group-btn">

                <?= Html::submitButton('搜索', ['class' => 'btn btn-primary btn-lg']) ?>
                
            </span>

        </div>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
<div class="clearfix col-md-7 col-md-offset-2" style="margin-top:20px;">
    <?php if(count($data)>0){?>
        
        <table class="table table-bordered">
            <tr>
                <th>姓名</th>
                <td><?=$data['client_name']?></td>
                <th>年龄</th>
                <td><?=$data['age']?>岁</td>
            </tr>
            <tr>
                <th>性别</th>
                <td><?=$data['sex'] == 0?'女':'男'?></td>
                <th>电话</th>
                <td><?=$data['telephone']?></td>
            </tr>
            <tr>
                <th>会员卡</th>
                <td><?=$data['member_card']?></td>
                <th>来源渠道</th>
                <td><?=\common\models\Customer::$static[$data['source']]?></td>
            </tr>
        </table>

        <div class="billing-operation-form" style="margin-top: 20px">
            
            <?php  $form = ActiveForm::begin([
                'options' => [
                    'class' => 'form-horizontal'
                ],
                'fieldConfig' => [
                    'template' => "
                            <div class='col-md-12 col-xs-12'>{input}</div>
                            <div class='col-xs-12'>{error}</div>
                            ",
                    'labelOptions' => ['class' => 'col-md-2 col-xs-2 control-label'],]

            ]); ?>

            <?php date_default_timezone_set('PRC');?>
            
            <?= $form->field($model, 'order_num')->textInput(['value' => date('Ymdhis',time()).rand(0,9),'type' => 'hidden'])->label(false) ?>
            
            <table class="table table-bordered">    

                <tr>
                    <th>项目名称</th>
                    <td>
                        <?= $form->field($model, 'surgical_id')->dropDownList(
                            $list,
                            ['prompt'=>'请选择手术项目……']
                        )->label(false) ?>
                        <label for="billingoperation-surgical_id" class="sr-only"></label>
                        
                    </td>
                    <th>执刀医师</th>
                    <td>
                        <?= $form->field($model, 'hakim_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map($role['hakim'],'id','username'),
                            ['prompt'=>'请选择执刀医师……']
                        )->label(false) ?>
                    </td>
                </tr>
                
                <tr>
                    <th>医师助理</th>
                    <td>
                        <?= $form->field($model, 'assistant_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map($role['assistant'],'id','username'),
                            ['prompt'=>'请选择医师助理……']
                        )->label(false) ?>
                    </td>
                    <th>护士</th>
                    <td>
                        <?= $form->field($model, 'nurse_id')->dropDownList(
                            \yii\helpers\ArrayHelper::map($role['nurse'],'id','username'),
                            ['prompt'=>'请选择护士……'])->label(false) ?>
                    </td>
                </tr>

                <tr>
                    <th>手术时间</th>
                    <td>
                        <?= $form->field($model, 'operation_time')->widget('kartik\daterange\DateRangePicker',[
                                'convertFormat'=>true,
                                'pluginOptions'=>[
                                    'timePicker'=>true,
                                    'timePickerIncrement'=>1,
                                    'locale'=>['format'=>'Y-m-d H:i:s']
                                ]
                            ]);
                        ?>
                    </td>
                    <th>手术费用</th>
                    <td>
                        <?= $form->field($model, 'surgery_cost')->textInput(['maxlength' => true])->label(false) ?>
                    </td>
                </tr>
            </table>
            
            <div class="form-group button-center">

                <?= Html::button('查看手术记录',['value' => Url::to(['record','id'=>$data['id']]), 'class' => 'btn btn-warning ModalButton'])?>

                <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

                <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>

            </div>
            <?php ActiveForm::end(); ?>
        </div>
    <?php }else{?>
        <?php if(isset($_GET['Search']['telephone'])):?>
            <div class="alert alert-warning" role="alert"><i class="glyphicon glyphicon-exclamation-sign"></i> 暂未查到用户信息，请到前台去登记用户信息！</div>
        <?php endif?>
    <?php }?>
</div>
<?php \yii\bootstrap\Modal::begin([
    'header' => '<h4>订单详情</h4>',
    'id' => 'modal',
    'size' => 'modal-lg',
]);
echo '<div id="modalContent"></div>';
\yii\bootstrap\Modal::end();
?>

<?php $this->registerJs('

    $("#billingoperation-surgical_id").change(function(){
            $.ajax({
                type: "POST",
                url: "' . Url::to(['ajax-price']) . '",
                data: {id:$(this).val()},
                success: function( data ){
                    $( "#billingoperation-surgery_cost" ).val(data);
                }
            });
    });
    $(".ModalButton").click(function(){
            $("#modal").modal("show").find("#modalContent").load($(this).attr("value"));
        });

')?>