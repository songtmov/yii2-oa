<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CustomerVisit */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    #customervisit-cause label{
        margin-right: 15px;
    }
</style>
<div class="customer-visit-form mt">

<!--    --><!--$form = ActiveForm::begin(); ?>-->
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
    
    <?= $form->field($model, 'cause')->radioList([0=>'咨询',1=>'手术']) ?>
    
    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
