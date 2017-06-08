<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ReturnVisit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="return-visit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'visit_id') ?>

    <?= $form->field($model, 'client_id') ?>

    <?= $form->field($model, 'client_status') ?>

    <?= $form->field($model, 'mode') ?>

    <?php // echo $form->field($model, 'is_satisfied') ?>

    <?php // echo $form->field($model, 'health') ?>

    <?php // echo $form->field($model, 'visit_content') ?>

    <?php // echo $form->field($model, 'response') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
