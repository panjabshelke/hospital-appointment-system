<?php

namespace console\controllers;

use backend\models\PatientAppointmentDetails;
use backend\models\PatientFollowUpDetails;
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
        echo "\r\n Check Appointment details. ".date('Y-m-d');
        echo $nextAppointmentDt = date('Y-m-d', strtotime(' +2 day'));
        $model = new PatientFollowUpDetails();
        $model->next_follow_up_date;
        $checkNextAppointmentData = PatientFollowUpDetails::find()->where(['next_follow_up_date' => $nextAppointmentDt])->all();
        if(!empty($checkNextAppointmentData)) {
            echo "\r\n Found next appointment matching condition.";

        } else {
            echo "\r\n not found next appointment.";
        }
        echo "\r\n :::::::::::::::::::::::::::::::::::::END:::::::::::::::::::::::::::::::::::::\r\n";
        die;
        die("save");
       echo "hello";
    }

    
}