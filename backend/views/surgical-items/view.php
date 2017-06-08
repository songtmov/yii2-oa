<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;
use common\models\Supplies;
/* @var $this yii\web\View */
/* @var $model common\models\SurgicalItems */

$this->title = $model->entry_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('common','Surgical Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surgical-items-view col-md-8 col-md-offset-2">

    <p>
        <?= Html::a(Yii::t('common','Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('common','Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('common','Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>项目名称</th>
                    <th>指导价格</th>
                    <th>排序</th>
                    <th>状态</th>
                    <th>创建时间</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $model->entry_name?></td>
                    <td><?= $model->guide_price?></td>
                    <td><?= $model->sort?></td>
                    <td><?= $model->status == 0?'隐藏':'显示'?></td>
                    <td><?= date('Y-m-d H:i:s',$model->created_time)?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php if ($model->parent_id !== 0):?>

    <div class="customer-form">

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

    <div class="panel panel-default clearfix">
        <div class="panel-heading">
            <i class="fa fa-medkit"></i> 耗材绑定
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> 添加</button>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            
            <?php foreach ($modelsAddress as $index => $modelAddress): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">耗材: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">

                        <?php
                            // necessary for update action.
                            if (!$modelAddress->isNewRecord) {
                                echo Html::activeHiddenInput($modelAddress, "[{$index}]id");
                            }
                        ?>
                        <div class="row">
                        <div class="col-md-4">

                                <?= $form->field($modelAddress,"[{$index}]cate_id")->dropDownList(
                                    \yii\helpers\ArrayHelper::map($cate,'id','name'),

                                    [
                                        'prompt'=>'请选择耗材分类……',
                                        
                                        'onchange'=>'
                                            var mythis = $(this);
                                            $.ajax({
                                                type: "POST",
                                                url: "' . Url::to(['supplies-buyer-order/ajax-list-show']) . '",
                                                data: {id:$(this).val()},
                                                success: function( data ){
                                                    if(data == 400){
                                                        alert("该分类下面没有耗材！");
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
                                <?= $form->field($modelAddress, "[{$index}]supplie_id")->dropDownList(
                                   \yii\helpers\ArrayHelper::map(Supplies::find()->all(),'id','name'),
                                    [
                                        'prompt'=>'请选择耗材……',
                                    ]
                                )?>
                                
                            </div>
                            <div class="col-md-4">
                                <?= $form->field($modelAddress, "[{$index}]number")->textInput([
                            
                                ]);?>
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
<?php endif?>

</div>
<div class="clearfix"></div>
