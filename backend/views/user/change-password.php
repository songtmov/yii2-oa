<?php

    use yii\helpers\Html;

    use yii\bootstrap\ActiveForm;

    /* @var $this yii\web\View */

    /* @var $form yii\bootstrap\ActiveForm */

    /* @var $model \mdm\admin\models\form\ChangePassword */

    $this->title = Yii::t('common', 'Change Password');

    $this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-signup mt">

    <div class="row">

        <div class="col-md-5 col-md-offset-3">

            <h1 style="text-align: center"><?= Html::encode($this->title) ?></h1>

            <p style="text-align: center">请填写以下字段以更改密码：</p>
            
            <?php $form = ActiveForm::begin([

                'id' => 'form-change',

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

            <?= $form->field($model, 'oldPassword')->passwordInput() ?>

            <?= $form->field($model, 'newPassword')->passwordInput() ?>

            <?= $form->field($model, 'retypePassword')->passwordInput() ?>

            <div class="form-group" style="text-align: center">

                <?= Html::submitButton(Yii::t('common', 'Change'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>

            </div>

            <?php ActiveForm::end(); ?>

        </div>

    </div>

</div>