<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Rest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'rest_start_time') ?>

    <?= $form->field($model, 'rest_over_time') ?>

    <?= $form->field($model, 'full_time') ?>

    <?php // echo $form->field($model, 'department_opinion') ?>

    <?php // echo $form->field($model, 'd_o_time') ?>

    <?php // echo $form->field($model, 'manager_opinion') ?>

    <?php // echo $form->field($model, 'm_o_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
