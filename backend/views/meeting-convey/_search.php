<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MeetingConvey */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meeting-convey-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'meeting_type') ?>

    <?= $form->field($model, 'meeting_topic') ?>

    <?= $form->field($model, 'meeting_address') ?>

    <?= $form->field($model, 'cstore_id') ?>

    <?php // echo $form->field($model, 'cstore_address') ?>

    <?php // echo $form->field($model, 'owner_id') ?>

    <?php // echo $form->field($model, 'owner_phone') ?>

    <?php // echo $form->field($model, 'cstore_number') ?>

    <?php // echo $form->field($model, 'cstore_area') ?>

    <?php // echo $form->field($model, 'manager_id') ?>

    <?php // echo $form->field($model, 'manager_phone') ?>

    <?php // echo $form->field($model, 'emplyees_number') ?>

    <?php // echo $form->field($model, 'training_date') ?>

    <?php // echo $form->field($model, 'hotel_name') ?>

    <?php // echo $form->field($model, 'hotel_address') ?>

    <?php // echo $form->field($model, 'hotel_floor') ?>

    <?php // echo $form->field($model, 'doctor_id') ?>

    <?php // echo $form->field($model, 'instructor_id') ?>

    <?php // echo $form->field($model, 'host_id') ?>

    <?php // echo $form->field($model, 'asistant_id') ?>

    <?php // echo $form->field($model, 'consultant_id') ?>

    <?php // echo $form->field($model, 'engineer_id') ?>

    <?php // echo $form->field($model, 'nurse_id') ?>

    <?php // echo $form->field($model, 'resident_id') ?>

    <?php // echo $form->field($model, 'cameraman_id') ?>

    <?php // echo $form->field($model, 'travel_arrangement') ?>

    <?php // echo $form->field($model, 'ticket') ?>

    <?php // echo $form->field($model, 'draw') ?>

    <?php // echo $form->field($model, 'invitation') ?>

    <?php // echo $form->field($model, 'box') ?>

    <?php // echo $form->field($model, 'vehicle_type') ?>

    <?php // echo $form->field($model, 'renter_id') ?>

    <?php // echo $form->field($model, 'marketing_responsible_id') ?>

    <?php // echo $form->field($model, 'meeting_responsible_id') ?>

    <?php // echo $form->field($model, 'ko_solution') ?>

    <?php // echo $form->field($model, 'place_solution') ?>

    <?php // echo $form->field($model, 'creattime') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
