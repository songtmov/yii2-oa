<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Leechdom */
/* @var $form yii\widgets\ActiveForm */
$this->registerCss('
    .field-leechdom-number{
        margin-bottom:0
    }
');
?>

<div class="leechdom-form mt">

    <?php  $form = ActiveForm::begin([
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
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_id')->dropDownList($list,['prompt'=>'请选择药品所属分类……']) ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
    <div class="help-block col-md-offset-2 col-xs-offset-3">药品编号可以不填写，系统会自动生成唯一的药品id，如果填写则使用填写的编号。</div>
    
    <?= $form->field($model, 'stock')->textInput() ?>
    
    <?= $form->field($model, 'types')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'standard')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'guide_price')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'stock_warning')->textInput(['value'=>$model->isNewRecord?1:$model->stock_warning]) ?>
    
    <div class="help-block col-md-offset-2 col-xs-offset-3">当商品库存低于该数值时，会提示库存不足。</div>
    
    <?= $form->field($model, 'status')->dropDownList([1=>'正常',0=>'停售'],['prompt'=>'请选择药品状态……']) ?>
    
    <?= $form->field($model, 'store_id')->hiddenInput(['value'=>Yii::$app->user->identity->store_id])->label(false) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
