<section>
    <div id="slider1" class="carousel slide bb5" data-ride="carousel">
        <!-- Indicators -->
        <!-- <ul class="carousel-indicators">
    <li data-target="#slider1" data-slide-to="0" class="active"></li>
    <li data-target="#slider1" data-slide-to="1"></li>
  </ul>-->
        <!-- The slideshow -->
        <div class="carousel-inner">
            <div class="carousel-item active"> <img src="img/banner1.jpg" alt="Los Angeles" width="1100" height="500">
                <div class="carousel-caption">
                    <h1 class="animate__animated animate__fadeInDown">"PILES FREE WORLD HOSPITALS" </h1>
                    <h3 class="captionbg  text-light text-black-20 xs-mb0 animate__animated animate_fadeInLeft">A painless treatment for Piles through Government of India Patented Injection/Applicator</h3>
                    <p class="text-dark text-16 animate__animated animate__fadeInLeft"> ISO Certified (9001-2015)</p>
                </div>
            </div>
            <div class="carousel-item"> <img src="img/banner2.jpg" alt="Chicago" width="1100" height="500">
                <div class="carousel-caption">
                    <h1 class="text-dark animate__animated animate__fadeInUp">"PILES FREE WORLD" </h1>
                    <h3 class=" text-light text-black-20 animate__animated  animate__bounce animate__faster"> <span class="captionbg">CAMPAIGN THROUGH INOCULATION APPROVED BY GOVERNMENT OF INDIA PATENT.</span> </h3>
                </div>
            </div>
        </div>
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#slider1" data-slide="prev"> <span class="carousel-control-prev-icon"></span> </a> <a class="carousel-control-next" href="#slider1" data-slide="next"> <span class="carousel-control-next-icon"></span> </a>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-lg-12 contact-form  col-12 col-md-12 col-xs-12 col-sm-12">
        <?php

        use yii\bootstrap\ActiveForm;

        $form = ActiveForm::begin(); 
        ?>
    
            <!-- <form class="" method="post" action="" name="ajax-form" id="ajax-form"> -->
                <h4 class="p-3 text-uppercase text-center wow fadeInUp">Book Appointment</h4>
                <div class="row">
                <div class="col-sm-4 col-xs-12 col-lg-4 col-md-4">
                 <div class="form-group mb4">                   
                    <!-- <?= $form->field($model, 'patient_name')->radioList([], ['itemOptions' => ['class' => 'available_date', 'style' => 'margin:0 10px']]) ?> -->
                        <?= $form->field($model, 'patient_name')->textInput(['maxlength' => true, 'placeholder' => 'Name'])->label(false) ?>
                        <!-- <input type="text" class="form-control  col-form-label-lg" id="colFormLabelSm" name="name" placeholder="Name"> -->
                    </div>
                </div>
                 <div class="col-sm-4 col-xs-12 col-lg-4 col-md-4">
                 <div class="form-group mb4">
      
                    <?= $form->field($model, 'patient_email')->textInput(['maxlength' => true, 'placeholder' => 'Email-ID'])->label(false) ?>
                        <!-- <input type="email" class="form-control  col-form-label-lg" id="colFormLabel" name="email_id" placeholder="Email"> -->
                    </div>
                </div>
                 <div class="col-sm-4 col-xs-12 col-lg-4 col-md-4">
                 <div class="form-group mb4">
                    <!-- <label for="colFormLabel" class="col-sm-2  col-12 col-form-label col-form-label-lg">Email</label>-->
                  
                        <?= $form->field($model, 'patient_contact_no')->textInput(['maxlength' => true, 'placeholder' => 'Contact No'])->label(false) ?>
                        <!-- <input type="Contact Number" class="form-control  col-form-label-lg" id="colFormLabel" name="contact_no" placeholder="Contact Number"> -->
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 col-lg-4 col-md-4">
                 <div class="form-group mb4">
                        <?= $form->field($model, 'branch_name')->dropDownList($activeBranches, ['prompt' => '(Select Branch)', 'class'=>'custom-select my-1 mr-sm-2'])->label(false) ?>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12 col-lg-4 col-md-4">
                 <div class="form-group mb4">
                        <?= $form->field($model, 'doctor_name')->dropDownList($activeDoctors, ['prompt' => '(Select Doctor Name)', 'class'=>'custom-select my-1 mr-sm-2'])->label(false) ?>
                    </div>
                </div>
                 <div class="col-sm-4 col-xs-12 col-lg-4 col-md-4">
                 <div class="form-group  mb4">
                    <div class="datepicker date input-group p-0 col-sm-12">
                        <input type="text" placeholder="Choose Appointment date" class="form-control  col-form-label-lg" id="reservationDate" name="reservationDate">
                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
                    </div>
                </div>  </div>

                <div class="col-sm-12">  
                <div class="form-group mb4">
                    <div id="timeslotTest" class="hide testClass">
                        <h4 style="font-size: 15px; text-transform: uppercase; background: #17a2b8; padding: 5px; color: #fff; margin:0px;">Select Time</h4>
                        <div class="timeslotbox">
                            <div class="mb-2"><span class="mr-1"><i class="fa indicate bg-success"></i> <small>Available Time </small></span><span class="mr-1"><i class="fa indicate bg-primary"></i> <small>Selected </small></span> <span><i class="fa indicate bg-secondary"></i> <small>Not Available Time</small></span></div>
                            <div id="available-time-slots" class=" btn-group-toggle" data-toggle="buttons">
                                <lable style="color:red;" >Select Branch, Doctor and Appointment date, for available time slot.</lable>
                                <!-- <label class="btn btn-secondary">
                                    <input type="radio" name="button" id="button1" autocomplete="off" checked> 9:20 AM
                                </label>

                                <label class="btn btn-success active">
                                    <input type="radio" name="button" id="button2" autocomplete="off">
                                    9:40 AM
                                </label>

                                <label class="btn btn-secondary">
                                    <input type="radio" name="button" id="button3" autocomplete="off">
                                    9:60 AM
                                </label>

                                <label class="btn btn-success">
                                    <input type="radio" name="button" id="button4" autocomplete="off">
                                    10:00 AM
                                </label>

                                <label class="btn btn-success">
                                    <input type="radio" name="button" id="button5" autocomplete="off">
                                    10:20 AM
                                </label> -->
                            </div> </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12  form-group row justify-content-center">
                    <button id="input-group-append" class="btn-sm btn btn-info text-uppercase">Book Appointment</button>
                </div>
                
                <!--  </div>-->
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 mb-3  xs-mt0  col-12 col-sm-12">
            <h2 class="text-uppercase"> Welcome to, </h2>
            <h3 class="text-blue"> "PILES FREE WORLD" CAMPAIGN THROUGH INOCULATION
                PATENT, APPROVED BY GOVERNMENT OF INDIA. </h3>
            <p class="text-black-20">This Treatment is unique in the medical history of the world, Because No Recurrence
                after treatment in whole life</p>
        </div>
    </div>
</div>
<section id="bg2" class="parallax first-widget">
    <div class="parallax-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 mt-5  p-4">
                    <h4 class="text-white">"PILES FREE WORLD HOSPITALS"</h4>
                    <p class="text-black-20">As a result of 40 years of research we have with our formally approved injection can cure piles, anal Fistula & Rectal prolapse.
                        In past twenty years we have curved over a lakh of patients by use this treatment.</p>
                    <a class="btn-sm btn btn-info text-uppercase" href="about.html">About Us</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class=" mt-3 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="main-heading mb-3">OUR BRANCHES</div>
            </div>
            <div class="col-lg-4 col-md-4 col-xl-4 col-sm-6">
                <div class="xs-mt0  box effect2">
                    <h3>CHINCHWAD (PUNE)</h3>
                    <p><i class="fa fa-map-marker"></i> Plot No. P.A.P. / G. /60, Thermax Chowk,<br />
                        Behind Kasturi Market,<br />
                        Majjid Road, Sambhaji Nagar,<br />
                        Chinchwad, Pune - 411019.</p>
                    <p><i class="fa fa-phone-square"></i> +91 9112675901 / 7038569384</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xl-4 col-sm-6">
                <div class="xs-mt0  box effect2">
                    <h3>Mumbai</h3>
                    <p><i class="fa fa-map-marker"></i> Shop No. 107, Chandrai Arcade,<br />
                        Plot No. A 12, 24,25,26, Near SBI Bank,<br />
                        Opposite Railway Station, Sector 20,<br />
                        Nerul West, Navi Mumbai, 400706.</p>
                    <p><i class="fa fa-phone-square"></i> +91 9082332830 / +91 9112675901</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xl-4 col-sm-6">
                <div class="xs-mt0  box effect2">
                    <h3>SURAT</h3>
                    <p><i class="fa fa-map-marker"></i> We are Launching it Soon..!<br />
                        <br />
                        <br />
                    </p>
                    <p><i class="fa fa-phone-square"></i> Coming Soon</p>
                </div>
            </div>
        </div>
    </div>
</section>
 
<script type="text/javascript">
$(document).ready(function(){ 
    <?php if ($statusChk == 'error-First') { ?>
        alert('Selected time slot not available.');
    <?php } else if($statusChk == "Success") { ?>
        alert('Your time slot successfully booked.');
    <?php } ?>
    // $(".contact-form").on('change', '#patientfollowupdetails-branch_name', function () {
    //     var validationChk = true;
    //     var reservationDate = $("#reservationDate").val();
    //     alert(reservationDate);
    // });
    $(".contact-form").on('click', '#input-group-append', function () {
        var branch_id = $("#patientfollowupdetails-branch_name").val();
        var doctor_id = $("#patientfollowupdetails-doctor_name").val();
        var patient_name = $("#patientfollowupdetails-patient_name").val();
        var patient_email = $("#patientfollowupdetails-patient_email").val();
        var patient_contact_no = $("#patientfollowupdetails-patient_contact_no").val();
        // var reservationDate = $("#book-time-slot").val();
        if(branch_id == "" || doctor_id == "" || patient_name == "" || patient_email == "" || patient_contact_no == "") {
            alert("All Book Appointment Form Fields Are Compulsary.");
            return false;
        }
        if(!$('#patientfollowupdetails-patient_contact_no').val().match('[0-9]{10}'))  {
            alert("Please put 10 digit mobile number");
            return false;
        } 
        if (typeof $("input:radio[name='book-time-slot']:checked").val() === 'undefined') {
            alert('Please select appointment date & time slot.');
            return false;
        }
        return true;
    });

    $(".contact-form").on('change', '#patientfollowupdetails-branch_name,#patientfollowupdetails-doctor_name', function () {
        $("#reservationDate").val("");
        $('#timeslotTest').addClass('hide');
    });

    $(".contact-form").on('change', '#reservationDate', function () {
        
        $('#timeslotTest').removeClass('hide');
        
        var reservationDate = $(this).val();
        var branch_id = $("#patientfollowupdetails-branch_name").val();
        var doctor_id = $("#patientfollowupdetails-doctor_name").val();
        $('#available-time-slots').empty();
        $.ajax({
            url: '<?php echo Yii::$app->getUrlManager()->createUrl('collect-available-slots') ?>',
            type: 'POST',
            data: {reservationDate: reservationDate, branch_id: branch_id, doctor_id: doctor_id},
            dataType: 'json',
            success: function (result) {
                if (result.status == "success") {
                    
                    $tmp = 1;
                    $.each(result.outputdata, function (index, timeSlotDetail) {
                        //'id' => $availableDetail->id, 'slot_time' => $availableDetail->available_time_slot, 'booking_status' => $availableDetail->booking_status];
                        // myArray.push([timeSlotDetail.id, timeSlotDetail.slot_time, timeSlotDetail.booking_status]);
                        var newAttr = '';//btn-success
                        var newClass = 'btn-success';
                        if(timeSlotDetail.booking_status == 'Yes') {
                            newAttr = "disabled='disabled'";
                            newClass = 'btn-secondary';
                        }
                        $('#available-time-slots').append('<label class="btn '+newClass+'">'+
                        '<input type="radio" '+newAttr+' name="book-time-slot" id="book-time-slot" autocomplete="off" value="'+timeSlotDetail.id+'"> '+timeSlotDetail.slot_time+'</label>');
                        $tmp++;
                    });
                } else {
                    // alert("Doctors are not available.");
                    $('#available-time-slots').append('<lable style="color:red;" >Doctors are not available.</lable>');
                }
            },
            complete: function (result) {
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#available-time-slots').append('<lable style="color:red;" >Try again after some time.</lable>');
            }
        });
    });
    
});
</script>