<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Position */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="position-form mt">

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

    <?= $form->field($model, 'department_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($department,'id','name'),[
            'prompt'=>'请选择所属部门……'
        ]
    ) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>'显示',0=>'隐藏'],[
        'prompt'=>'请选择状态'
    ]) ?>

    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">成立时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';

        echo DateRangePicker::widget([
        'name'=>'Position[found_time]',
        
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


    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
