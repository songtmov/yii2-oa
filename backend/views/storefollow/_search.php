<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StoreFollow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-follow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'cooperation') ?>

    <?= $form->field($model, 'fail_reason') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'backup') ?>

    <?php // echo $form->field($model, 'sub_time') ?>

    <?php // echo $form->field($model, 'store_name') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'boss') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
