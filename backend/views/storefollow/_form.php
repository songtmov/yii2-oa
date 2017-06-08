<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
$user_id = yii::$app->user->id;
?>

<div class="store-follow-form mt">

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

<?php if(empty($_SERVER["HTTP_REFERER"]) || explode('/', $_SERVER["HTTP_REFERER"])[4] == 'personal'){
        echo $form->field($model, 'store_name')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\CStore::find()->where(['business'=>$user_id])->all(),'store_name','store_name'),
            'language' => 'zh-CN',
            'options' => ['placeholder' => '请选择美容院……'],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]);
    }else{
        echo $form->field($model, 'store_name')->widget(Select2::classname(), [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\CStore::find()->all(),'store_name','store_name'),
            'language' => 'zh-CN',
            'options' => ['placeholder' => '请选择美容院……'],
            'pluginOptions' => [
                'allowClear' => true
            ]
        ]);
    }?>
    
    <?= $form->field($model, 'phone')->textInput()->label('手机号码') ?>

    <?= $form->field($model, 'boss')->textInput(['maxlength' => true])->label('老板名') ?>
    
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    
    <?= $form->field($model, 'cooperation')->dropDownList([ '0'=>'手机', '1'=>'微信', '2' =>'QQ', '3' => '短信', '4' => '面谈'], ['prompt' => '请选择渠道来源……'])->label('洽谈方式') ?>
    
    <?= $form->field($model, 'fail_reason')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'backup')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_time')->textInput(['type' => 'hidden'])->label(false) ?>
    
    <?= $form->field($model, 'user_id')->textInput(['value' => $_SESSION['__id'],'type' => 'hidden'])->label(false) ?>
    
    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
