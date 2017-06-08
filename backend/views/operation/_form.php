<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BillingOperation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billing-operation-form mt">

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

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'surgical_id')->textInput() ?>

    <?= $form->field($model, 'hakim_id')->textInput() ?>

    <?= $form->field($model, 'assistant_id')->textInput() ?>

    <?= $form->field($model, 'nurse_id')->textInput() ?>

    <?= $form->field($model, 'surgery_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'counselor_id')->textInput() ?>

    <?= $form->field($model, 'store_id')->textInput() ?>

    <?= $form->field($model, 'sale_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'operation_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
