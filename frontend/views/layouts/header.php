<?php

use backend\models\CategoryMaster;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

?>
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div id="bookapointment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="text-uppercase text-center wow fadeInUp">Book Appointment</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body booking-form">
                            <!-- Tab panes -->
                            <!-- <form class="" target="_blank" method="post" action="book_appointment.php" name="ajax-form" id="ajax-form"> -->
                            <?php
                            $doctorID = Yii::$app->params['doctors_id'];
                            $branchID = Yii::$app->params['branches_id'];
                            $allDoctors = CategoryMaster::getParentCategories($doctorID, false);
                            $allBranches = CategoryMaster::getParentCategories($branchID, false);
                            $activeDoctors = ArrayHelper::map($allDoctors, 'id', 'category_name');
                            $activeBranches = ArrayHelper::map($allBranches, 'id', 'category_name');
                            $form = ActiveForm::begin(['action' =>['/'], 'method' => 'post', 'id' => 'patientfollowupdetails']); 
                            ?>
                                <div class="form-group mb4">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control  col-form-label-lg" id="patient_name" name="patient_name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group mb4">
                                    <div class="col-sm-12">
                                        <input type="email" class="form-control  col-form-label-lg" id="patient_email" name="patient_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group mb4">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control  col-form-label-lg" id="patient_contact_no" name="patient_contact_no" placeholder="Contact Number">
                                    </div>
                                </div>
                                <div class="form-group mb4">
                                    <div class="col-sm-12">
                                        <select class="custom-select my-1 mr-sm-2" id="branch_name" name="branch_name">
                                            <option selected>Select Branch</option>
                                        <?php 
                                            foreach($activeBranches as $branchId => $branchDetails) {
                                                echo '<option value="'.$branchId.'">'.$branchDetails.'</option>';
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group mb4">
                                    <div class="col-sm-12">
                                        <select class="custom-select my-1 mr-sm-2" id="doctor_name" name="doctor_name">
                                            <option selected>Select Doctor</option>
                                        <?php 
                                            foreach($activeDoctors as $doctorId => $doctorDetails) {
                                                echo '<option value="'.$doctorId.'">'.$doctorDetails.'</option>';
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 mb4">
                                    <div class="datepicker date input-group p-0 col-sm-12">
                                        <input type="text" placeholder="Choose Appointment date" class="form-control  col-form-label-lg" id="reservationDatePopup" name="reservationDatePopup">
                                        <div class="input-group-append"><span class="input-group-text px-4"><i class="fa fa-calendar"></i></span></div>
                                    </div>
                                </div>
                                <div class="form-group mb4">
                                    <div id="timeslot">
                                        <h4>Select Time</h4>
                                        <div class="timeslotbox">
                                            <div class="mb-2"><span class="mr-1"><i class="fa indicate bg-success"></i> <small>Available Time </small></span><span class="mr-1"><i class="fa indicate bg-primary"></i> <small>Selected </small></span> <span><i class="fa indicate bg-secondary"></i> <small>Not Available Time</small></span></div>
                                            <div id="available-time-slots-div" class=" btn-group-toggle" data-toggle="buttons">
                                                <lable style="color:red;" >Select Branch, Doctor and Appointment date, for available time slot.</lable>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 mb-3 form-group row justify-content-center">
                                    <button type="submit" id="input-group-append-popup" class="btn-sm btn btn-info text-uppercase" type="submit">Book Appointment</button>
                                </div>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<section>
    <header id="header" class="site-header clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 col-md-12 xs-p-1">
                    <a href="index.html"> <img src="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>img/logo.png" width="auto" height="85" alt="logo" class="p-1 logo" /> <span class="text-uppercase logo-text-1">Piles Free</span> <span class="logo-text-2">World Hospitals</span> </a>
                    
                    <span class="text-center contact-bg pull-right">+91 9112675901</small></span>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-dark blue-bg info-color ">
            <div class="container flex-xs-row-reverse flex-sm-row-reverse"> <a href="bookappointment.html" class="btn btn-sm border-info btn-dark" data-toggle="modal" data-target="#bookapointment"> Book Appointment</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                <div class="collapse navbar-collapse" id="navmenu">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"> <a class="nav-link" href="<?=Yii::getAlias('@root')?>">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link" href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/about">About Us </a> </li>
                        <li class="nav-item"> <a class="nav-link" href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/our-specifications"> Our Specifications </a> </li>
                        <li class="nav-item"> <a class="nav-link" href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/our-branches"> Our Branches </a> </li>
                        <li class="nav-item"> <a class="nav-link " href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/our-gallery"> Our Gallery </a> </li>
                        <li class="nav-item"> <a class="nav-link " href="<?=Yii::getAlias('@root') . DIRECTORY_SEPARATOR?>site/contact"> Contact Us</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</section>