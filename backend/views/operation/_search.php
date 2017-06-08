<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Operation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="billing-operation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'surgical_id') ?>

    <?= $form->field($model, 'hakim_id') ?>

    <?= $form->field($model, 'assistant_id') ?>

    <?php // echo $form->field($model, 'nurse_id') ?>

    <?php // echo $form->field($model, 'surgery_cost') ?>

    <?php // echo $form->field($model, 'counselor_id') ?>

    <?php // echo $form->field($model, 'store_id') ?>

    <?php // echo $form->field($model, 'sale_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'operation_time') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
