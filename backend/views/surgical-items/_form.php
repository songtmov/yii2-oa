<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\SurgicalItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surgical-items-form mt">

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
    
    <?= $form->field($model, 'parent_id')->dropDownList($list,['value'=>$model->parent_id]) ?>
    
    <?= $form->field($model, 'entry_name')->textInput(['maxlength' => false]) ?>
    
    <?= $form->field($model, 'guide_price')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'sort')->textInput(['value'=>'100']) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>'显示',0=>'隐藏'],['prompt'=>'请选择状态']) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


