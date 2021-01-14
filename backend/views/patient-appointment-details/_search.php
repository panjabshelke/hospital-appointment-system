<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientAppointmentDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-appointment-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'doctor_availability_id') ?>

    <?= $form->field($model, 'doctor_id') ?>

    <?= $form->field($model, 'branch_id') ?>

    <?= $form->field($model, 'doctor_name') ?>

    <?php // echo $form->field($model, 'branch_name') ?>

    <?php // echo $form->field($model, 'available_date') ?>

    <?php // echo $form->field($model, 'available_time_slot') ?>

    <?php // echo $form->field($model, 'slot_type') ?>

    <?php // echo $form->field($model, 'booking_status') ?>

    <?php // echo $form->field($model, 'appointment_category') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'patient_name') ?>

    <?php // echo $form->field($model, 'patient_contact_no') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'modified_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

