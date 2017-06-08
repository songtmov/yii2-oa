<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model common\models\meetapply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meetapply-form mt">
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

    <?= $form->field($model, 'ma_meetname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ma_content')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'ma_countpeople')->textInput() ?>

    <?= $form->field($model, 'ma_department')->textInput(['maxlength' => true]) ?>
    
    <!-- <?//= $form->field($model, 'ma_starttime')->textInput(['maxlength' => true]) ?> -->
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">开始时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
        
        echo DateRangePicker::widget([
            'name'=>'Meetapply[ma_starttime]',
            // 'value'=>$model->isNewRecord ?'': date('Y-m-d',$model->ma_starttime),
            'value'=>$model->isNewRecord ? '': $model -> ma_starttime,
            'useWithAddon'=>true,
            'pluginOptions'=>[
                'class'=>'form-control',
                'singleDatePicker'=>true,
                'showDropdowns'=>true
            ]
        ]);
        echo '</div></div>';
    ?>
    
    <?php echo '<div class="form-group field-position-found_time required">
        <label class="col-md-2 col-xs-2 control-label" for="position-found_time">结束时间</label>
        <div class="col-md-10 col-xs-9 input-group drp-container" style="padding: 0 15px">';
            
    echo DateRangePicker::widget([
        'name'=>'Meetapply[ma_endtime]',
        // 'value'=>$model->isNewRecord ?'':date('Y-m-d',$model->ma_endtime),
        'value'=>$model->isNewRecord ? '' : $model -> ma_endtime,
        'useWithAddon'=>true,
        'pluginOptions'=>[
            'class'=>'form-control',
            'singleDatePicker'=>true,
            'showDropdowns'=>true
        ]
    ]);
    echo '</div></div>';
    ?>
    
    <?= $form->field($model, 'ma_meetaddress')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'ma_speaker')->textInput(['maxlength' => true]) ?>
    
    <!-- <?//= $form->field($model, 'ma_createtime')->textInput(['maxlength' => true]) ?> -->
    
    <!-- <?//= $form->field($model, 'ma_endtime')->textInput(['maxlength' => true]) ?> -->
    
    <!-- <input type="hidden" name="ma_createtime" value="<?//=time()?>"> -->
    
    <?= $form->field($model, 'ma_type')->dropDownList([ '0' => '内部', '1' => '外部', ], ['prompt' => '']) ?>
    
    <?= $form->field($model, 'ma_remark')->textarea(['rows' => 6]) ?>
    
    <!-- <?//= $form->field($model, 'ma_loginstatus')->dropDownList([ '0', '1', ], ['prompt' => '']) ?> -->

    <!-- <?//= $form->field($model, 'ma_applystatus')->dropDownList([ '0', '1', ], ['prompt' => '']) ?> -->
    
    <!-- <?//= $form->field($model, 'ma_feedback')->textarea(['rows' => 6]) ?> -->
    
    <!-- <?//= $form->field($model, 'ma_see')->dropDownList([ '0', '1', ], ['prompt' => '']) ?> -->

    <!-- <?//= $form->field($model, 'ma_uid')->textInput(['maxlength' => true]) ?> -->
    
    <input type="hidden" name="Meetapply[ma_uid]" value="<?=$_SESSION['__id']?>">
    
    <input type="hidden" name="Meetapply[ma_createtime]" value="<?=time()?>">
    
    <!-- <?//= $form->field($model, 'ma_mid')->textInput(['maxlength' => true]) ?> -->

    <!-- <?//= $form->field($model, 'ma_new')->dropDownList([ '0', '1', ], ['prompt' => '']) ?> -->
    
    <!-- <?//= $form->field($model, 'ma_delete')->textInput() ?> -->
    
    <!-- <input type="hidden" name="ma_delete" value="0"> -->

    <!-- <?//= $form->field($model, 'ma_hint')->dropDownList([ '' => '', ], ['prompt' => '']) ?> -->
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
