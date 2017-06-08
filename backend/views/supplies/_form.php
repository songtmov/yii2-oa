<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Supplies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplies-form mt">

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

    <?= $form->field($model, 'cate_id')->dropDownList($list,['prompt'=>'请选择所属分类……']) ?>
    
    <?= $form->field($model, 'stock')->textInput() ?>
    
    <?= $form->field($model, 'types')->textInput(['maxlength' => true]) ?>
    
    <!-- <?//= $form->field($model, 'store_id')->textInput() ?> -->
    
    <?= $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Store::find()->all(),'id','name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择门店……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?= $form->field($model, 'status')->dropDownList([1=>'正常',0=>'停售'],['prompt'=>'请选择耗材状态']) ?>
    
    <?= $form->field($model, 'stock_warning')->textInput(['value'=>$model->isNewRecord?1:$model->stock_warning]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>
