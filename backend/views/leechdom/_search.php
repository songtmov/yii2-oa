<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Leechdom */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="leechdom-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'cate_id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'types') ?>

    <?php // echo $form->field($model, 'standard') ?>

    <?php // echo $form->field($model, 'guide_price') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'stock_warning') ?>

    <?php // echo $form->field($model, 'store_id') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
