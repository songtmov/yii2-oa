<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Check */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="check-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cate_id') ?>

    <?= $form->field($model, 'item_id') ?>

    <?= $form->field($model, 'paper_num') ?>

    <?php // echo $form->field($model, 'actual_num') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'deviation') ?>

    <?php // echo $form->field($model, 'deviation_reason') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
