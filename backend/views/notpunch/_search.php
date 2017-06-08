<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Notpunch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notpunch-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'full_time') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'not_punch_time') ?>

    <?= $form->field($model, 'not_punch_interval') ?>

    <?php // echo $form->field($model, 'not_punch_reason') ?>

    <?php // echo $form->field($model, 'depart_opinion') ?>

    <?php // echo $form->field($model, 'manager_opinion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
