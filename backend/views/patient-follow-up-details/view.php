<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientFollowUpDetails */

$this->title = $model->patient_contact_no;
$this->params['breadcrumbs'][] = ['label' => 'Patient Follow Up Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="patient-follow-up-details-view">
<?php
// $patientDetails
    $temp = 1;
    foreach($patientDetails as $patientDetail) {
        // print_r($patientDetail);die;
?>
        <div style="background-color: white;border: 1px solid gray;margin:5px; margin-bottom:15px">
            <div class="panel-heading">
                <b>Appointment No. <?=$temp++?> :</b>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered detail-view">
                    <tr>
                        <th>Doctor Name</th>
                        <td><?=$patientDetail->doctor_name?></td>
                        <th>Branch Name</th>
                        <td><?=$patientDetail->branch_name?></td>
                    </tr>
                    <tr>
                        <th>Patient Name</th>
                        <td><?=$patientDetail->patient_name?></td>
                        <th>E-Mail</th>
                        <td><?=$patientDetail->patient_email?></td>
                    </tr>
                    <tr>
                        <th>Appointment Date</th> 
                        <td><?=$patientDetail->available_date ." ( {$patientDetail->available_time_slot} )"?></td>
                        <th>Next Follow Up Date</th>
                        <td><?=$patientDetail->next_follow_up_date?></td>
                    </tr>
                    <tr>
                        <th colspan="6">Doctor Prescription</th>
                    </tr>
                    <tr>
                        <td colspan="6"><?= strip_tags($patientDetail->doctor_prescription) ?></td>
                    </tr>
                    <tr>
                        <th>Follow UP Change Date</th>
                        <td><?=$patientDetail->modified_at?></td>
                        <td colspan="2">
                            <div style="text-align: right;" ><?= Html::a('Update', ['update', 'id' => $patientDetail->id], ['class' => 'btn btn-primary']) ?></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
<?php
    }
?>
<div class="row">
    <div class="col-md-3">

    </div>
    <div class="col-md-3">
        
    </div>
    <div class="col-md-3">

    </div>
    <div class="col-md-3">
        
    </div>
</div>
    
</div>
