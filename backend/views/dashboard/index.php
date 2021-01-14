<?php
/* @var $this View */

use app\modules\icm\models\IcmDashboard;
use yii\web\View;
use app\modules\icm\models\IcmJob;
use yii\helpers\Url;

$this->title = 'Dashboard';

$totalOverallDescoveredDevices = $totalUnknownOverallDevices = 100;
$overallDescoveredDevices['up'] = 40;
$overallDescoveredDevices['down'] = 60;

$unknownOverallDescoveredDevices = $overallDescoveredDevices;
// 'doctors' => count($allDoctors), 'branches' => count($allBranches), 
//                       'pending' => $pendingAppointments, 'available' => $availableAppointments,
//                       'confirmed' => $confirmedAppointments, 'completed' => $completedAppointments,
?>
<div class="container-fluid">    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default text-center">
            <div class="panel-heading" role="tab" id="heading-network-discovery">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-network-discovery" aria-expanded="true" aria-controls="collapse-network-discovery">
                        Hospital Details
                    </a>
                </h4>
            </div>
            <div id="collapse-network-discovery" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-network-discovery">
                <div class="panel-body">
                    <div class="tilesCode">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="text-center lab-box-style">
                                    <h2 class="lab-inner-title">Available Doctors</h2>
                                    <h2><?=$dashboardData['doctors']?></h2>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center lab-box-style">
                                    <h2 class="lab-inner-title">Available Branches</h2>
                                    <h2><?=$dashboardData['branches']?></h2>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="text-center lab-box-style">
                                    <h2 class="lab-inner-title">Available Users</h2>
                                    <h2><?=$dashboardData['doctors']?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="panel panel-default text-center">
            <div class="panel-heading" role="tab" id="heading-todays-hostpital-details">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-todays-hostpital-details" aria-expanded="true" aria-controls="collapse-todays-hostpital-details">
                        Hospital Today's Appointment Details
                    </a>
                </h4>
            </div>
            <div id="collapse-todays-hostpital-details" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-todays-hostpital-details">
                <div class="panel-body">
                    <div class="tilesCode">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[available_date]=<?=date('Y-m-d')?>&PatientAppointmentDetailsSearch[status]=Pending">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Pending </h2>
                                        <h2><?=$dashboardData['today-pending']?></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[available_date]=<?=date('Y-m-d')?>&PatientAppointmentDetailsSearch[status]=Confirmed">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Confirmed </h2>
                                        <h2><?=$dashboardData['today-confirmed']?></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[available_date]=<?=date('Y-m-d')?>&PatientAppointmentDetailsSearch[status]=Available">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Available </h2>
                                        <h2><?=$dashboardData['today-available']?></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[available_date]=<?=date('Y-m-d')?>&PatientAppointmentDetailsSearch[status]=Completed">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Completed </h2>
                                        <h2><?=$dashboardData['today-completed']?></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        <div class="panel panel-default text-center">
            <div class="panel-heading" role="tab" id="heading-hostpital-details">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-hostpital-details" aria-expanded="true" aria-controls="collapse-hostpital-details">
                        Hospital Appointment Details
                    </a>
                </h4>
            </div>
            <div id="collapse-hostpital-details" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-hostpital-details">
                <div class="panel-body">
                    <div class="tilesCode">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[status]=Pending">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Pending </h2>
                                        <h2><?=$dashboardData['pending']?></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[status]=Confirmed">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Confirmed </h2>
                                        <h2><?=$dashboardData['confirmed']?></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[status]=Available">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Available </h2>
                                        <h2><?=$dashboardData['available']?></h2>
                                    </div>
                                </a>
                            </div>
                            <div class="col-sm-3">
                                <a href="patient-appointment-details/index?PatientAppointmentDetailsSearch[status]=Completed">
                                    <div class="text-center lab-box-style">
                                        <h2 class="lab-inner-title">Completed </h2>
                                        <h2><?=$dashboardData['completed']?></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>

.view-hostpital-details-up-down-status:hover{
                            cursor: pointer;
                        }
                    .lab-performance-list{
                        display: flex;
                        justify-content: space-around;
                        list-style: outside none none;
                        margin: 30px 114px 10px;
                        padding: 0;
                        text-align: center;
                    }
    .panel-default>.panel-heading {
        color: #333;
        background-color: #fff;
        border-color: #e4e5e7;
        padding: 0;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .panel-default>.panel-heading a {
        display: block;
        padding: 10px 15px;
    }

    .panel-default>.panel-heading a:after {
        content: "";
        position: relative;
        top: 1px;
        display: inline-block;
        font-family: 'Glyphicons Halflings';
        font-style: normal;
        font-weight: 400;
        line-height: 1;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        float: right;
        transition: transform .25s linear;
        -webkit-transition: -webkit-transform .25s linear;
    }

    .panel-default>.panel-heading a[aria-expanded="true"] {
        background-color: #eee;
    }

    .panel-default>.panel-heading a[aria-expanded="true"]:after {
        content: "\2212";
        -webkit-transform: rotate(180deg);
        transform: rotate(180deg);
    }

    .panel-default>.panel-heading a[aria-expanded="false"]:after {
        content: "\002b";
        -webkit-transform: rotate(90deg);
        transform: rotate(90deg);
    }

    .accordion-option {
        width: 100%;
        float: left;
        clear: both;
        margin: 15px 0;
    }

    .accordion-option .title {
        font-size: 20px;
        font-weight: bold;
        float: left;
        padding: 0;
        margin: 0;
    }

    .accordion-option .toggle-accordion {
        float: right;
        font-size: 16px;
        color: #6a6c6f;
    }

    .accordion-option .toggle-accordion:before {
        content: "Expand All";
    }

    .accordion-option .toggle-accordion.active:before {
        content: "Collapse All";
    }

    .panel{
        box-shadow: 2px 2px 4px #000000;
    }

    .lab-box-style:hover{
        box-shadow: 2px 2px 2px 2px #eee;
    }

    .lab-box-style{
        border: 2px solid #eee;
        border-radius: 10px;
    }
</style>
<script type="text/javascript">

    $(document).ready(function () {

        $(".toggle-accordion").on("click", function () {
            var accordionId = $(this).attr("accordion-id"),
                    numPanelOpen = $(accordionId + ' .collapse.in').length;

            $(this).toggleClass("active");

            if (numPanelOpen == 0) {
                openAllPanels(accordionId);
            } else {
                closeAllPanels(accordionId);
            }
        })

        openAllPanels = function (aId) {
            console.log("setAllPanelOpen");
            $(aId + ' .panel-collapse:not(".in")').collapse('show');
        }
        closeAllPanels = function (aId) {
            console.log("setAllPanelclose");
            $(aId + ' .panel-collapse.in').collapse('hide');
        }

    });

    $(window).load(function () {
        Pizza.init();
//        loadModelChart();        
//        loadSoftwareVersionsChart();
        loadDevicePieChart();
        loadSoftwareVersionsPieChart();
    });
</script>

<?php
$cofigurationICMDetailsUrl = Url::to(['/icm/icm-task/index']);
$JS = <<<JS
        $('.view-icm-configuration-details').on('click', function(){
            
            var status = $(this).data('status');
            var job_type = $(this).data('report-type');
            var job = $(this).parents('ul').data('job-type');
            
            if(typeof job == 'undefined')
            {
                job = $(this).data('job-type');
            }
        
            var type = $(this).parents('ul').data('report-type');
            var report_date = $("#icmdashboard-date").val();
            var url = "{$cofigurationICMDetailsUrl}";
            
            switch(job){
              case "configuration":                       
                        url += "?IcmTaskSearch[status]="+status+"&IcmTaskSearch[job_type]="+0;               
                    break;
              case "compliance":
                        url += "?IcmTaskSearch[status]="+status+"&IcmTaskSearch[job_type]="+1;                                                
                    break;
            }         
            if(type == "datewise"){
                url += "&IcmTaskSearch[executed_at]="+report_date;
            }
            window.open(url);
        });
        
JS;
$this->registerJs($JS);
