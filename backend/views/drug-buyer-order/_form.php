<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\touchspin\TouchSpin;

$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("药品: " + (index + 1))
    });
});

//jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
//    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
//        jQuery(this).html("药品: " + (index + 1))
//    });
//});
';

$this->registerJs($js);
?>

<div class="customer-form mt">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    
    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 50, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsAddress[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'full_name',
            'address_line1',
            'address_line2',
            'city',
            'state',
            'postal_code',
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-medkit"></i> 药品采购
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> 添加</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsAddress as $index => $modelAddress): ?>
                <!-- <?php //p(//$modelsAddress);die;?> -->
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">药品: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                        <div class="col-md-3">
                                <?= $form->field($modelAddress,"[{$index}]cate_id")->dropDownList(
                                    \yii\helpers\ArrayHelper::map($cate,'id','name'),
                                    [
                                        'prompt'=>'请选择药品分类……',
                                        'onchange'=>'
                                            var mythis = $(this);
                                            $.ajax({
                                                type: "POST",
                                                url: "' . Url::to(['ajax-list-show']) . '",
                                                data: {id:$(this).val()},
                                                success: function( data ){
                                                    if(data == 400){
                                                        alert("该分类下面没有药品！");
                                                        mythis.find("option").attr("selected",false);
                                                        mythis.parents(".row").children("div:nth-child(2)").find("option").attr("selected",false);
                                                        mythis.parents(".row").children("div:last-child").find("input").val( "" );
                                                    }else{
                                                       mythis.parents(".row").children("div:nth-child(2)").find("select").html( data ); 
                                                    }
                                                    
                                                }
                                            });
                                        '
                                    ]
                                )?>
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($modelAddress, "[{$index}]leechdom_id")->dropDownList(
                                   \yii\helpers\ArrayHelper::map([],'id','name'),
                                    [
                                        'prompt'=>'请选择药品……',
                                    ]
                                )?>

                            </div>
                            <div class="col-md-5">
                                <?= $form->field($modelAddress, "[{$index}]number")->textInput([]);?>
                            </div>
                        </div>

                    </div>

                </div>
            <?php endforeach; ?>
        </div>
        <div class="panel-footer">

            <button type="button" class="add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> 添加</button>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>

    <div class="form-group" style="text-align:center">
        <?= Html::submitButton($modelAddress->isNewRecord ? '提交' : '修改', ['class' => 'btn btn-success','style'=>'padding:6px 25px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
