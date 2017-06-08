<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'client_name') ?>
    
    <?= $form->field($model, 'telephone') ?>

    <?= $form->field($model, 'member_card') ?>

    <?= $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'sex') ?>
    
    <?php //echo $form->field($model, 'cstore_id') ?>
    
    <?php // echo $form->field($model, 'source') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'sale_id') ?>

    <?php // echo $form->field($model, 'service_id') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
