<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Store */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="store-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'province') ?>

    <?= $form->field($model, 'city') ?>

    <?= $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'Store_image') ?>

    <?php // echo $form->field($model, 'acreage') ?>

    <?php // echo $form->field($model, 'head_id') ?>

    <?php // echo $form->field($model, 'contact_number') ?>

    <?php // echo $form->field($model, 'store_created_time') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
