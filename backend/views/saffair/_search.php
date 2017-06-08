<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\saffair */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="saffair-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer') ?>

    <?= $form->field($model, 'province') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'county') ?>

    <?php // echo $form->field($model, 'hospital') ?>

    <?php // echo $form->field($model, 'appointment') ?>

    <?php // echo $form->field($model, 'appointment_type') ?>

    <?php // echo $form->field($model, 'doctor') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
