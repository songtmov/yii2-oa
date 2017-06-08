<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\meetapply */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meetapply-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ma_id') ?>

    <?= $form->field($model, 'ma_content') ?>

    <?= $form->field($model, 'ma_meetname') ?>

    <?= $form->field($model, 'ma_countpeople') ?>

    <?= $form->field($model, 'ma_department') ?>

    <?php // echo $form->field($model, 'ma_starttime') ?>

    <?php // echo $form->field($model, 'ma_endtime') ?>

    <?php // echo $form->field($model, 'ma_speaker') ?>

    <?php // echo $form->field($model, 'ma_createtime') ?>

    <?php // echo $form->field($model, 'ma_type') ?>

    <?php // echo $form->field($model, 'ma_loginstatus') ?>

    <?php // echo $form->field($model, 'ma_applystatus') ?>

    <?php // echo $form->field($model, 'ma_meetaddress') ?>

    <?php // echo $form->field($model, 'ma_feedback') ?>

    <?php // echo $form->field($model, 'ma_remark') ?>

    <?php // echo $form->field($model, 'ma_see') ?>

    <?php // echo $form->field($model, 'ma_uid') ?>

    <?php // echo $form->field($model, 'ma_mid') ?>

    <?php // echo $form->field($model, 'ma_new') ?>

    <?php // echo $form->field($model, 'ma_delete') ?>

    <?php // echo $form->field($model, 'ma_hint') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
