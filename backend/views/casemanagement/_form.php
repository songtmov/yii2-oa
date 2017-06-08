<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use kartik\form\ActiveForm;

?>

<div class="case-management-form mt">

<?php
    $form = ActiveForm::begin([
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
    ]); 

    echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(),'id','client_name'),
        'language' => 'zh-CN',
        'pluginOptions' => [
            'allowClear' => true,
            'placeholder' => 'Select...'
        ]
    ]);
?>
    <?= $form->field($model, 'path')->fileInput()->label('文件上传') ?>

    <b style="position: relative;left:25%;top:0em;color:red;">仅限文件上传格式：zip,rar,7z </b>
    
    <?= $form->field($model, 'nbackup')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
    
</div>
