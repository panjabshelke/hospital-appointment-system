<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientAppointmentDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="patient-appointment-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'doctor_availability_id')->textInput() ?>

    <?= $form->field($model, 'doctor_id')->textInput() ?>

    <?= $form->field($model, 'branch_id')->textInput() ?>

    <?= $form->field($model, 'doctor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'available_date')->textInput() ?>

    <?= $form->field($model, 'available_time_slot')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slot_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'booking_status')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'appointment_category')->dropDownList([ 'First visit' => 'First visit', 'Follow Up' => 'Follow Up', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Available' => 'Available', 'Pending' => 'Pending', 'Confirmed' => 'Confirmed', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'patient_contact_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'modified_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

