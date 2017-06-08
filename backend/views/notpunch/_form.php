<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Notpunch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notpunch-form mt">

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
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">未打卡日期</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
    echo DateRangePicker::widget([
        'name'=>'NotPunch[not_punch_time]',
        'value'=>$model->isNewRecord ?'':date('Y-m-d',$model->found_time),
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
   
    <?= $form->field($model, 'not_punch_interval')->dropDownList(
        [
            'prompt'=> '请选择类型……','1' => '上午','0'=>'下午'
        ]
    ) ?>
    
    <?= $form->field($model, 'not_punch_reason')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'depart_opinion')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'manager_opinion')->textarea(['rows' => 6]) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>
    
    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true,'type' => 'hidden','value' => $_SESSION['__id']])->label(false);?>
    
    <?php ActiveForm::end(); ?>
    
</div>
