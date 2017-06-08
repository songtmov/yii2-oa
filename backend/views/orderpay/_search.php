<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderPay */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-pay-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'billing_id') ?>

    <?= $form->field($model, 'isall') ?>

    <?= $form->field($model, 'sum_money') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'nbackup') ?>

    <?php // echo $form->field($model, 'sub_time') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
