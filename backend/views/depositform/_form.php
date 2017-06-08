<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\DepositForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="deposit-form-form mt">

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
    
    <?= $form->field($model, 'billing_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\BillingOperation::find()->all(),'order_num','order_num'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请输入手术订单号……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('手术订单');?>

    <!-- <?//= $form->field($model, 'billing_id')->textInput() ?> -->
    
    <?= $form->field($model, 'deposit')->textInput(['maxlength' => true,'placeholder' => '单位为*元']) ?>

    <?= $form->field($model, 'payment_method')->dropDownList([ '2' => '转帐', '1' => '刷卡', '0' => '现金'], ['prompt' => '请选择收款方式...'])->label('收款方式') ?>
    
    <?= $form->field($model, 'nbackup')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'user_id')->textInput(['type' => 'hidden','value' => yii::$app->user->id])->label(false) ?>
    
    <?php date_default_timezone_set('PRC'); ?>
    
    <?= $form->field($model, 'sub_time')->textInput(['type' => 'hidden','value' => date('Y-m-d h:i:s',time())])->label(false) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
