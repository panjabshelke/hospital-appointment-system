<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\PatientFollowUpDetails */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Add Patient Follow Up Details: ';
$this->params['breadcrumbs'][] = ['label' => 'Patient Follow Up', 'url' => ['patient-data']];
$this->params['breadcrumbs'][] = 'Add';
?>

<div class="patient-follow-up-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'patient_appointemnt_details_fk')->hiddenInput()->label(false) ?>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'patient_contact_no')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'patient_email')->textInput(['maxlength' => true, 'readonly' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'doctor_prescription')->textarea(['rows' => 1])->widget(CKEditor::className()) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4" id="next_follow_up_date-div">
            <label>Next Follow Up Date</label>
            <?= 
            DatePicker::widget([
                'name' => 'PatientFollowUpDetails[next_follow_up_date]',
                'id' => 'patientfollowupdetails-next_follow_up_date',
                'value' => $model->next_follow_up_date,
                // 'aria-required' => true,
                'class' => 'form-control',
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    'startDate' => date('Y-m-d',time()),
                ]
            ])
            ?>
           <div class="help-block" id="next_follow_up_date-error-div"></div>
           
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
<!-- // -->
<script type="text/javascript">
//next_follow_up_date-div next_follow_up_date-div  next_follow_up_date-error-div
    // patientfollowupdetails-next_follow_up_date has-error"
    // $(".patient-follow-up-details-form").on('change', '#patientfollowupdetails-next_follow_up_date', function () {
    //     var followUpDt = this.val();
    //     alert(followUpDt);
    //     return false;
    //     if(followUpDt == '' || followUpDt == " ") {
    //         $("#next_follow_up_date-error-div").html("Next Follow Up Date cannot be blank.");
    //     } else {
    //         $("#next_follow_up_date-error-div").html("");
    //     }
    // });

    // $(".btn-save-booking").click(function () {
    //     var validationChk = true;
    //     var patientName = $("#patientappointmentdetails-patient_name").val();

    // });
</script>