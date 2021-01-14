<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\DoctorAvailability */
/* @var $form yii\widgets\ActiveForm */
$this->title = 'Book Appointment';
$this->params['breadcrumbs'][] = ['label' => 'Patient Appointment Details', 'url' => ['/patient-appointment-details']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="appointment-details-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <h4>Available Dates</h4>
            <div id="elem">
                <?= $form->field($model, 'available_date')->radioList($availableDates, ['itemOptions' => ['class' => 'available_date checkbox-tools', 'style' => 'margin:0 10px']])->label(false) ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($model, 'branch_id')->dropDownList($activeBranches) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'doctor_id')->dropDownList($activeDoctors, [ ]) ?>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 available_time_slot" >
            <?= $form->field($model, 'available_time_slot')->radioList([], ['itemOptions' => ['class' => 'available_date', 'style' => 'margin:0 10px']]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4" >
                    <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4" >
                    <?= $form->field($model, 'patient_contact_no')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-4" >
                    <?= $form->field($model, 'patient_email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4" >
                    <?= $form->field($model, 'appointment_category')->dropDownList([ 'First visit' => 'First visit', 'Follow Up' => 'Follow Up', ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4" >
            <?= $form->field($model, 'status')->dropDownList([ 'Available' => 'Available', 'Pending' => 'Pending', 'Confirmed' => 'Confirmed', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled', ] ) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-save-booking']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">
$(document).ready(function(){ 
    $(".btn-save-booking").click(function () {
        var validationChk = true;
        var patientName = $("#patientappointmentdetails-patient_name").val();
        if (patientName == "" || patientName == undefined) {
            $('#patientappointmentdetails-patient_name').next('.help-block').text('Patient name cannot be blank.');
            $('#patientappointmentdetails-patient_name').parent('.form-group').addClass('has-error');
            validationChk = false;
        } else {
            $('#patientappointmentdetails-patient_name').next('.help-block').text('');
            $('#patientappointmentdetails-patient_name').parent('.form-group').removeClass('has-error');
        }
        var patientContactNo = $("#patientappointmentdetails-patient_contact_no").val();
        if (patientContactNo == "" || patientContactNo == undefined) {
            $('#patientappointmentdetails-patient_contact_no').next('.help-block').text('Patient contact no cannot be blank.');
            $('#patientappointmentdetails-patient_contact_no').parent('.form-group').addClass('has-error');
            validationChk = false;
        } else {
            $('#patientappointmentdetails-patient_contact_no').next('.help-block').text('');
            $('#patientappointmentdetails-patient_contact_no').parent('.form-group').removeClass('has-error');
        }
        var patientEmail = $("#patientappointmentdetails-patient_email").val();
        if (patientEmail == "" || patientEmail == undefined) {
            $('#patientappointmentdetails-patient_email').next('.help-block').text('Patient email-id cannot be blank.');
            $('#patientappointmentdetails-patient_email').parent('.form-group').addClass('has-error');
            validationChk = false;
        } else {
            $('#patientappointmentdetails-patient_email').next('.help-block').text('');
            $('#patientappointmentdetails-patient_email').parent('.form-group').removeClass('has-error');
        }
        var patientEmail = $("#patientappointmentdetails-appointment_category").val();
        if (patientEmail == "" || patientEmail == undefined) {
            $('#patientappointmentdetails-appointment_category').next('.help-block').text('Appointment category cannot be blank.');
            $('#patientappointmentdetails-appointment_category').parent('.form-group').addClass('has-error');
            validationChk = false;
        } else {
            $('#patientappointmentdetails-appointment_category').next('.help-block').text('');
            $('#patientappointmentdetails-appointment_category').parent('.form-group').removeClass('has-error');
        }
        var patientEmail = $("#patientappointmentdetails-status").val();
        if (patientEmail == "" || patientEmail == undefined) {
            $('#patientappointmentdetails-status').next('.help-block').text('Status cannot be blank.');
            $('#patientappointmentdetails-status').parent('.form-group').addClass('has-error');
            validationChk = false;
        } else {
            $('#patientappointmentdetails-status').next('.help-block').text('');
            $('#patientappointmentdetails-status').parent('.form-group').removeClass('has-error');
        }
        return validationChk;
    });

    $(".appointment-details-form").on('change', '#patientappointmentdetails-branch_id', function () {
        var selectedBr = $(this).val();
        var selectedDt = $('input[name="PatientAppointmentDetails[available_date]"]:checked').val();
        $('#patientappointmentdetails-doctor_id').empty();
        $('#patientappointmentdetails-available_time_slot').empty();
        $('#patientappointmentdetails-doctor_id').append('<option value="">Select-Available-Doctor</option>');
        $.ajax({
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('doctor-availability/collect-available-slots') ?>',
            type: 'POST',
            data: {selectedBranch: selectedBr, selectedDate: selectedDt},
            dataType: 'json',
            success: function (result) {
                if (result.status == "success") {
                    for (const [key, value] of Object.entries(result.outputdata)) {
                        // console.log(`${key}: ${value}`);
                        $('#patientappointmentdetails-doctor_id').append('<option value="'+key+'">'+value+'</option>');
                    }
                } else {
                    alert("Doctors are not available.");
                }
            },
            complete: function (result) {
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $(".appointment-details-form").on('change', '#patientappointmentdetails-doctor_id', function () {
        var selectedDr = $(this).val();
        var selectedDt = $('input[name="PatientAppointmentDetails[available_date]"]:checked').val();
        var selectedBr = $('#patientappointmentdetails-branch_id').val();
        $('#patientappointmentdetails-available_time_slot').empty();
        console.log(`Selected date:`+selectedDt+ ` Selected branch-`+selectedBr+ ` Selected Dr-`+selectedDr);
        $.ajax({
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('doctor-availability/collect-available-slots') ?>',
            type: 'POST',
            data: {selectedDoctor: selectedDr, selectedBranch: selectedBr, selectedDate: selectedDt},
            dataType: 'json',
            success: function (result) {
                if (result.status == "success") {
                    // var myArray = [];
                    $.each(result.outputdata, function (index, timeSlotDetail) {
                        //'id' => $availableDetail->id, 'slot_time' => $availableDetail->available_time_slot, 'booking_status' => $availableDetail->booking_status];
                        // myArray.push([timeSlotDetail.id, timeSlotDetail.slot_time, timeSlotDetail.booking_status]);
                        var newAttr = '';
                        if(timeSlotDetail.booking_status == 'Yes')
                            newAttr = "disabled='disabled'";
                        $('#patientappointmentdetails-available_time_slot').append(
                                "<label><input type='radio' "+newAttr+" name='PatientAppointmentDetails[available_time_slot]' value= "+timeSlotDetail.id+" style='margin:0 10px'> "+ timeSlotDetail.slot_time +"</label>");
                    });
                    // alert(myArray);
                    // for (const [key, value] of Object.entries(result.outputdata)) {
                    //     console.log(`${key}: ${value}`);
                    //     $('#patientappointmentdetails-available_time_slot').append(
                    //             "<label><input type='radio' name='PatientAppointmentDetails[available_time_slot]' value= "+key+" style='margin:0 10px'> "+ value +"</label>");
                    // }
                } else {
                    alert("Doctors are not available.");
                }
            },
            complete: function (result) {
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    $("#elem").on('change', '.available_date', function () {
        var availableDt = $(this).val();
        $('#patientappointmentdetails-doctor_id').empty();
        $('#patientappointmentdetails-branch_id').empty();
        $('#patientappointmentdetails-available_time_slot').empty();
        $('#patientappointmentdetails-branch_id').append('<option value="">Select-Available-Branch</option>');
        $('#patientappointmentdetails-doctor_id').append('<option value="">Select-Available-Doctor</option>');
            // .append('<option selected="selected" value="test">White</option>');
        // alert(availableDt);
        // return false;
        $.ajax({
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('doctor-availability/collect-available-slots') ?>',
            type: 'POST',
            data: {availableDate: availableDt},
            dataType: 'json',
            success: function (result) {
                if (result.status == "success") {
                    for (const [key, value] of Object.entries(result.outputdata)) {
                        // console.log(`${key}: ${value}`);
                        $('#patientappointmentdetails-branch_id').append('<option value="'+key+'">'+value+'</option>');
                    }
                } else {
                    alert("Doctors are not available on the selected date.");
                }
            },
            complete: function (result) {
            },
            error: function (jqXHR, textStatus, errorThrown) {
            }
        });
    });

    
    $(function() {
        var print = function(msg) {
            alert(msg);
        };

        var setInvisible = function(elem) {
            elem.css('visibility', 'hidden');
        };
        var setVisible = function(elem) {
            elem.css('visibility', 'visible');
        };

        var elem = $("#elem");
        var items = elem.children();

        // Inserting Buttons
        elem.prepend('<div id="right-button" style="visibility: hidden;"><a href="#"><</a></div>');
        elem.append('  <div id="left-button"><a href="#">></a></div>');

        // Inserting Inner
        items.wrapAll('<div id="inner" />');

        // Inserting Outer
        debugger;
        elem.find('#inner').wrap('<div id="outer"/>');

        var outer = $('#outer');

        var updateUI = function() {
            var maxWidth = outer.outerWidth(true);
            var actualWidth = 0;
            $.each($('#inner >'), function(i, item) {
                actualWidth += $(item).outerWidth(true);
            });

            if (actualWidth <= maxWidth) {
                setVisible($('#left-button'));
            }
        };
        updateUI();



        $('#right-button').click(function() {
            var leftPos = outer.scrollLeft();
            outer.animate({
                scrollLeft: leftPos - 500
            }, 800, function() {
                debugger;
                if ($('#outer').scrollLeft() <= 0) {
                    setInvisible($('#right-button'));
                }
            });
        });

        $('#left-button').click(function() {
            setVisible($('#right-button'));
            var leftPos = outer.scrollLeft();
            outer.animate({
                scrollLeft: leftPos + 500
            }, 800);
        });

        $(window).resize(function() {
            updateUI();
        });
    });
});
</script>
<style>
/* #patientappointmentdetails-available_time_slot  [type="radio"]:checked + label{
	
    padding: 6px !important;
    border:5px solid blue !important;
}
#patientappointmentdetails-available_time_slot  [type="radio"]:not(:checked) + label {
	
    padding: 6px !important;
    border:5px solid blue !important;
}
label [type="radio"]:checked {
    border:5px solid gray !important;
} */

    /* display: inline-block; */
    #outer {
        float: left;
        width: 900px;
        overflow: hidden;
        white-space: nowrap;
        display: inline-block;
    }
    /* style="visibility: visible;margin-top: 5px;padding: 5px;" */
    #left-button {
        float: left;
        width: 30px;
        text-align: center;
        background-color: gray;
        margin-top:5px;
        padding: 5px;
    }

    #right-button {
        float: left;
        width: 30px;
        text-align: center;
        background-color: gray;
        margin-top:5px;
        padding: 5px;
    }

    #left-button a, #right-button a {
        text-decoration: none;
        font-weight: bolder;
        color: red;
    }

    #inner {
        margin: 10px 0;
    }
    #inner:first-child {
        margin-left: 0;
    }

    label {
        margin-left: 10px;
    }

    .hide {
        display: none;
    }
</style>