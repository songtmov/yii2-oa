<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerRecords */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-records-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'pay') ?>

    <?= $form->field($model, 'visited_problem') ?>

    <?= $form->field($model, 'after_time') ?>

    <?= $form->field($model, 'operating_position') ?>

    <?php // echo $form->field($model, 'visited_time') ?>

    <?php // echo $form->field($model, 'visited_id') ?>

    <?php // echo $form->field($model, 'visited_mode') ?>

    <?php // echo $form->field($model, 'visited_content') ?>

    <?php // echo $form->field($model, 'bed_position') ?>

    <?php // echo $form->field($model, 'ishealthy') ?>

    <?php // echo $form->field($model, 'customer_detail') ?>

    <?php // echo $form->field($model, 'service_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
