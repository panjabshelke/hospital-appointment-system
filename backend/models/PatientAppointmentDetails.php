<?php

namespace backend\models;

use Yii;
use DateInterval;
use DatePeriod;
use DateTime;

/**
 * This is the model class for table "tbl_patient_appointment_details".
 *
 * @property int $id
 * @property int $doctor_availability_id
 * @property int $doctor_id
 * @property int $branch_id
 * @property string $doctor_name
 * @property string $branch_name
 * @property string $available_date
 * @property string $available_time_slot
 * @property string|null $slot_type
 * @property string|null $booking_status Yes - Booking Completed, No - Not Booked Yet
 * @property string|null $appointment_category
 * @property string|null $status
 * @property string|null $patient_name
 * @property string|null $patient_contact_no
 * @property string|null $patient_email
 * @property string $created_at
 * @property string $modified_at
 */
class PatientAppointmentDetails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_patient_appointment_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_availability_id', 'doctor_id', 'branch_id', 'doctor_name', 'branch_name', 'available_date', 'available_time_slot'], 'required'],
            [['doctor_availability_id', 'doctor_id', 'branch_id'], 'integer'],
            [['available_date', 'created_at', 'modified_at'], 'safe'],
            [['slot_type', 'booking_status', 'appointment_category', 'status'], 'string'],
            [['doctor_name', 'branch_name', 'patient_name'], 'string', 'max' => 255],
            [['available_time_slot', 'patient_email'], 'string', 'max' => 100],
            ['patient_email', 'email'],
            ['patient_contact_no', 'number'],
            [['patient_contact_no'], 'string', 'min' => 10, 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_availability_id' => 'Doctor Availability ID',
            'doctor_id' => 'Doctor ID',
            'branch_id' => 'Branch ID',
            'doctor_name' => 'Doctor Name',
            'branch_name' => 'Branch Name',
            'available_date' => 'Available Date',
            'available_time_slot' => 'Available Time Slot',
            'slot_type' => 'Slot Type',
            'booking_status' => 'Booking Status',
            'appointment_category' => 'Appointment Category',
            'status' => 'Status',
            'patient_name' => 'Patient Name',
            'patient_contact_no' => 'Patient Contact No',
            'patient_email' => 'Patient Email-ID',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    public static function updateAppointmentDetails($appointmentData, $doctorAvailabilityId)
    {
        $available_from = date('Y-m-d H:i', strtotime($appointmentData['available_from']));
        $available_upto = date('Y-m-d H:i', strtotime($appointmentData['available_upto']));
        $minutes = date('i', strtotime($available_from));
        $hour = date('H', strtotime($available_from));
        if ($minutes >= 30) 
            $hour++;

        $available_from = date('Y-m-d', strtotime($available_from));
        $available_from = $available_from." ".$hour.":00";

        // consider nearest hour for available time
        // $available_upto = date('Y-m-d H:i', strtotime($appointmentData['available_upto']));
        // $minutes = date('i', strtotime($available_upto));
        // $hour = date('H', strtotime($available_upto));
        // if ($minutes <= 20) 
        //     $hour--;
        // $available_upto = date('Y-m-d', strtotime($available_upto));
        // $available_upto = $available_upto." ".$hour.":00";

        $availableTimeSlots = self::splitTime($available_from, $available_upto, "20");
        if (!empty($availableTimeSlots) && !empty($doctorAvailabilityId)) {
            $doctorDetails = CategoryMaster::categoryDetails($appointmentData['doctor_id']);
            $branchDetails = CategoryMaster::categoryDetails($appointmentData['branch_id']);
            foreach ($availableTimeSlots as $available_date => $availableTimeSlot) {
                foreach ($availableTimeSlot as $slot_type => $slotTimeData) {
                    foreach ($slotTimeData as $available_time_slot) {
                        if (!empty($available_time_slot)) {
                            $model = new PatientAppointmentDetails();
                            $model->setAttributes($appointmentData);
                            $model->doctor_availability_id = $doctorAvailabilityId;
                            $model->doctor_name = (isset($doctorDetails->category_name) && !empty($doctorDetails->category_name)) ? $doctorDetails->category_name : "-";
                            $model->branch_name = (isset($branchDetails->category_name) && !empty($branchDetails->category_name)) ? $branchDetails->category_name : "-";
                            $model->booking_status = 'No';
                            $model->status = 'Available';
                            $model->available_date = $available_date;
                            $model->slot_type = $slot_type;
                            $model->available_time_slot = $available_time_slot;
                            $model->save();
                        }
                    }
                }
            }
        }
    }

    public static function splitTime($StartTime, $EndTime, $Duration = "60")
    {
        $ReturnArray = array(); // Define output
        $StartTime    = strtotime($StartTime); //Get Timestamp
        $EndTime      = strtotime($EndTime); //Get Timestamp

        $AddMins  = $Duration * 60;
        // Morning Afternoon', 'Evening
        while ($StartTime <= $EndTime) //Run loop
        {
            $date = date("Y-m-d", $StartTime);
            $timeSlot = date("G", $StartTime);
            $appointmentTime = Yii::$app->params['appointmentTime'];
            // $startDate = $reservationDate . " " . $appointmentTime['Morning']['start'] . ":00:00";
            //Morning Appointment Slots
            if ($timeSlot < $appointmentTime['Morning']['end'] && $timeSlot >= $appointmentTime['Morning']['start']) {
                $ReturnArray[$date]['Morning'][] = date('h:i A', $StartTime);
            }
            //Afternoon Appointment Slots
            if ($timeSlot < $appointmentTime['Afternoon']['end'] && $timeSlot >= $appointmentTime['Afternoon']['start']) {
                $ReturnArray[$date]['Afternoon'][] = date('h:i A', $StartTime);
            }
            //Evening Appointment Slots
            if ($timeSlot < $appointmentTime['Evening']['end'] && $timeSlot >= $appointmentTime['Evening']['start']) {
                $ReturnArray[$date]['Evening'][] = date("h:i A", $StartTime);
            }
            $StartTime += $AddMins; //Endtime check
        }
        return $ReturnArray;
    }

    public static function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {

        // Declare an empty array 
        $array = array();

        // Variable that store the date interval 
        // of period 1 day 
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        // Use loop to store date into array 
        foreach ($period as $date) {
            $array[$date->format('Y-m-d')] = $date->format($format);
        }

        // Return the array elements 
        return $array;
    }
}
