<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Evection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="evection-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'province') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'store_id') ?>

    <?php // echo $form->field($model, 'evection_time') ?>

    <?php // echo $form->field($model, 'evection_reason') ?>

    <?php // echo $form->field($model, 'evection_info') ?>

    <?php // echo $form->field($model, 'evection_img') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
