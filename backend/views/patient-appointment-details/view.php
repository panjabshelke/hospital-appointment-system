<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientAppointmentDetails */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Patient Appointment Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="patient-appointment-details-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'doctor_availability_id',
            // 'doctor_id',
            // 'branch_id',
            'doctor_name',
            'branch_name',
            'available_date',
            'available_time_slot',
            'slot_type',
            'booking_status',
            'appointment_category',
            'status',
            'patient_name',
            'patient_contact_no',
            'created_at',
            'modified_at',
        ],
    ]) ?>

</div>

