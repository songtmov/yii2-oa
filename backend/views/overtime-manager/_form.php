<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\overtime */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="overtime-form mt">

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

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'fill_time')->textInput() ?>

    <?= $form->field($model, 'work_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_reason')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'executive_opinion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'department_opinion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'manager_opinion')->textarea(['rows' => 6]) ?>

    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
