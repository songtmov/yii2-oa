<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerProfiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-profiles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?= $form->field($model, 'billing_id') ?>

    <?= $form->field($model, 'surger_date') ?>

    <?= $form->field($model, 'starting_time') ?>

    <?php // echo $form->field($model, 'finishing_time') ?>

    <?php // echo $form->field($model, 'dignosis_before') ?>

    <?php // echo $form->field($model, 'type_of_anesthesia') ?>

    <?php // echo $form->field($model, 'anesesiologistID') ?>

    <?php // echo $form->field($model, 'is_clear') ?>

    <?php // echo $form->field($model, 'change_clothes') ?>

    <?php // echo $form->field($model, 'skin_preparation') ?>

    <?php // echo $form->field($model, 'remove_jewelry') ?>

    <?php // echo $form->field($model, 'pathway') ?>

    <?php // echo $form->field($model, 'medicine_name') ?>

    <?php // echo $form->field($model, 'medicine_specification') ?>

    <?php // echo $form->field($model, 'transfusion_time') ?>

    <?php // echo $form->field($model, 'nuresID') ?>

    <?php // echo $form->field($model, 'hepatitis_B') ?>

    <?php // echo $form->field($model, 'hepatitis_C') ?>

    <?php // echo $form->field($model, 'AIDS') ?>

    <?php // echo $form->field($model, 'syphilis') ?>

    <?php // echo $form->field($model, 'blood_sugar') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
