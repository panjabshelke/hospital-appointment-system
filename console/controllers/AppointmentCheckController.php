<?php

namespace console\controllers;

use backend\models\PatientAppointmentDetails;
use backend\models\PatientFollowUpDetails;
use common\models\User;
use Yii;
use yii\console\Controller;

/**
 * AppointmentCheckController implements the CRUD actions for Appliance model.
 */
class AppointmentCheckController extends Controller
{
   

    /**
     * Check next appointment status
     * @return mixed
     */
    public function actionIndex()
    {
        echo "\r\n :::::::::::::::::::::::::::::::::::::START:::::::::::::::::::::::::::::::::::::\r\n";
        echo "\r\n Check Appointment details. ".date('Y-m-d'). " ::::: Next Appointment Date - ";
        echo $nextAppointmentDt = date('Y-m-d', strtotime(' +2 day'));
        $model = new PatientFollowUpDetails();
        $model->next_follow_up_date;
        $checkNextAppointmentData = PatientFollowUpDetails::find()->alias('paud')
                                ->select(['paud.*', PatientAppointmentDetails::tableName().'.branch_name', PatientAppointmentDetails::tableName().'.available_time_slot', PatientAppointmentDetails::tableName().'.doctor_name', PatientAppointmentDetails::tableName().'.available_date'])
                                ->innerJoin(PatientAppointmentDetails::tableName(), PatientAppointmentDetails::tableName() . ".id = paud.patient_appointemnt_details_fk")
                                ->where(['paud.next_follow_up_date' => $nextAppointmentDt])->all();
        if(!empty($checkNextAppointmentData)) {
            echo "\r\n Found next appointment matching condition.";
            foreach($checkNextAppointmentData as $nextAppointmentDetails) {
                $userModel = new User();
                $userModel->sendNextAppointmentMail($nextAppointmentDetails);
                die;
            }
        } else {
            echo "\r\n not found next appointment.";
        }
        echo "\r\n :::::::::::::::::::::::::::::::::::::END:::::::::::::::::::::::::::::::::::::\r\n";
        die;
        die("save");
       echo "hello";
    }

    
}