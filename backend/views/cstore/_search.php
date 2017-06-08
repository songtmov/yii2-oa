<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cstore */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cstore-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>
    
    <?= $form->field($model, 'store_name') ?>

    <!-- <?//= $form->field($model, 'province') ?> -->

    <!-- <?//= $form->field($model, 'city') ?> -->

    <?= $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'hospital') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'telephone') ?>

    <?php // echo $form->field($model, 'acreage') ?>

    <?php // echo $form->field($model, 'store_photo') ?>

    <?php // echo $form->field($model, 'boss') ?>

    <?php // echo $form->field($model, 'boss_photo') ?>

    <?php // echo $form->field($model, 'encamp') ?>

    <?php // echo $form->field($model, 'consultation') ?>

    <?php // echo $form->field($model, 'business') ?>

    <?php // echo $form->field($model, 'county') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
