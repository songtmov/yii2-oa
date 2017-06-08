<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DrugBuyerOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="drug-buyer-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'buyer_number') ?>

    <?= $form->field($model, 'store_id') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'applicant_id') ?>

    <?php // echo $form->field($model, 'buyer_id') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
