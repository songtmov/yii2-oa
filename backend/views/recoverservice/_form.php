<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\rating\StarRating;

/* @var $this yii\web\View */
/* @var $model common\models\RecoverService */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recover-service-form mt">

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
    ])->label('手术订单号');?>
    
    <?= $form->field($model, 'most_satisfied')->dropDownList(['鼻子'=>'鼻子','下巴'=>'下巴','眼睛'=>'眼睛','唇'=>'唇','额头'=>'额头','轮廓'=>'轮廓','泪沟'=>'泪沟','太阳穴'=>'太阳穴','苹果肌'=>'苹果肌','法今纹'=>'法今纹','眼袋'=>'眼袋','颧骨凹陷'=>'颧骨凹陷'], ['prompt' => '请选择客户最满意的部位...']) ?>
    
    <?= $form->field($model, 'not_most_satisfied')->dropDownList(['鼻子'=>'鼻子','下巴'=>'下巴','眼睛'=>'眼睛','唇'=>'唇','额头'=>'额头','轮廓'=>'轮廓','泪沟'=>'泪沟','太阳穴'=>'太阳穴','苹果肌'=>'苹果肌','法今纹'=>'法今纹','眼袋'=>'眼袋','颧骨凹陷'=>'颧骨凹陷'], ['prompt' => '请选择客户最不满意的部位...']) ?>
    
    <?= $form->field($model, 'grade')->widget(StarRating::classname(), [
            'pluginOptions' => ['size'=>'lg']
        ]);
    ?>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
