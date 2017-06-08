<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'filecode') ?>

    <?= $form->field($model, 'customer_birthday') ?>

    <?= $form->field($model, 'husband_birthday') ?>

    <?php // echo $form->field($model, 'merry_day') ?>

    <?php // echo $form->field($model, 'children_birthday') ?>

    <?php // echo $form->field($model, 'customer_nature') ?>

    <?php // echo $form->field($model, 'pay_times') ?>

    <?php // echo $form->field($model, 'habit') ?>

    <?php // echo $form->field($model, 'attitude') ?>

    <?php // echo $form->field($model, 'emotion') ?>

    <?php // echo $form->field($model, 'care_about') ?>

    <?php // echo $form->field($model, 'hobby') ?>

    <?php // echo $form->field($model, 'years') ?>

    <?php // echo $form->field($model, 'total_sals') ?>

    <?php // echo $form->field($model, 'healthy') ?>

    <?php // echo $form->field($model, 'plastic_items') ?>

    <?php // echo $form->field($model, 'plastic_part') ?>

    <?php // echo $form->field($model, 'attidute') ?>

    <?php // echo $form->field($model, 'hospital') ?>

    <?php // echo $form->field($model, 'old_manner') ?>

    <?php // echo $form->field($model, 'buy_type') ?>

    <?php // echo $form->field($model, 'all_evaluate') ?>

    <?php // echo $form->field($model, 'is_old_customer') ?>

    <?php // echo $form->field($model, 'backup') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
