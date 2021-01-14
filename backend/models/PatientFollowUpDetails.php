<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_patient_follow_up_details".
 *
 * @property int $id
 * @property int $patient_appointemnt_details_fk
 * @property string|null $patient_name
 * @property string|null $patient_contact_no
 * @property string|null $patient_email
 * @property string|null $doctor_prescription
 * @property string $next_follow_up_date
 * @property string $created_at
 * @property string $modified_at
 */
class PatientFollowUpDetails extends \yii\db\ActiveRecord
{
    public $doctor_name, $branch_name, $available_date, $available_time_slot;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_patient_follow_up_details';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['patient_appointemnt_details_fk', 'next_follow_up_date', 'created_at'], 'required'],
            [['patient_appointemnt_details_fk'], 'integer'],
            [['doctor_prescription'], 'string'],
            [['next_follow_up_date', 'created_at', 'modified_at'], 'safe'],
            [['patient_name', 'patient_email'], 'string', 'max' => 100],
            [['patient_contact_no'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'patient_appointemnt_details_fk' => 'Patient Appointemnt Details Fk',
            'patient_name' => 'Patient Name',
            'patient_contact_no' => 'Patient Contact No',
            'patient_email' => 'Patient Email',
            'doctor_prescription' => 'Doctor Prescription',
            'next_follow_up_date' => 'Next Follow Up Date',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }
}
