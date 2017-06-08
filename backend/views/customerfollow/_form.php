<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerFollow */
/* @var $form yii\widgets\ActiveForm */
?>

<?=Html::jsFile('@web/***/js/***.js')?>

<div class="customer-follow-form mt">

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

    <!-- <?//= $form->field($model, 'customer_id')->textInput() ?> -->
    
    <?= $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'id','client_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择客户姓名……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])->label('顾客姓名');?>
    
    <script type="text/javascript">

        // #select2-orderpay-billing_id-container
    </script>

    <?= $form->field($model, 'follow_mode')->dropDownList([ '3' => '电话', '2' => '微信', '1' => '面约', '0' => '其它'], ['prompt' => '']) ?>
    
    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fail_resource')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'user_id')->textInput(['type' => 'hidden','value' => $_SESSION['__id']])->label(false) ?>

    <?php date_default_timezone_set('PRC');?>
    
    <?= $form->field($model, 'sub_time')->textInput(['type' => 'hidden','value' => date('Y-m-d h:i:s',time())])->label(false)?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
