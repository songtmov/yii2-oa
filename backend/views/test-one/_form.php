<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Test */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="test-form mt">
    
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
    
    <?= $form->field($model, 'id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Cstore::find()->all(),'id','store_name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>

    <!-- <?//= $form->field($model, 'id')->textInput(['maxlength' => true]) ?> -->
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
