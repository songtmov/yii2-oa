<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\UserModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-model-form mt">
    
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
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
    
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'repassword_hash')->passwordInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telphone')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'store_id')->widget(Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\common\models\Store::find()->all(),'id','name'),
        'language' => 'zh-CN',
        'options' => ['placeholder' => '请选择所属门店……'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);?>
    
    <?= $form->field($model, 'department_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\common\models\Department::find()->where(['status'=>1])->all(),'id','name'),[
            'prompt' => '请选择所属部门……',
            'onchange'=> '
                $.ajax({
                    type: "POST",
                    url: "' . Url::to(['ajax-list-show']) . '",
                    data: {id:$(this).val()},
                    success: function( data ){
                        $( "select#usermodel-position_id" ).html( data );
                    }
                });'
        ]
    ) ?>
    
    <?= $form->field($model, 'position_id')->dropDownList(
        $model->position_id ? ArrayHelper::map(\common\models\Position::find()->where(['department_id' => $model->department_id])->all(), 'id', 'name') : [],[
            'prompt'=> '请选择职务……',
        ]
    ) ?>

    <div class="form-group button-center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('common','Create' ): Yii::t('common','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('common','Reset' ), ['class' =>'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
