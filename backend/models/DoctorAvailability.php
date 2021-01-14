<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tbl_doctor_availability".
 *
 * @property int $id
 * @property int $doctor_id
 * @property int $branch_id
 * @property string $available_from
 * @property string $available_upto
 * @property string $status
 * @property string $created_at
 * @property string $modified_at
 */
class DoctorAvailability extends \yii\db\ActiveRecord
{
    public $category_type;
    public $doctor_name;
    public $branch_name, $available_date, $available_time_slot;
    
    const DOCTOR_AVAILABILITY_STATUS = ['Approved'=>'Approved', 'Pending'=>'Pending', 'Cancelled'=>'Cancelled'];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_doctor_availability';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['doctor_id', 'branch_id', 'available_from', 'available_upto'], 'required'],
            [['doctor_id', 'branch_id'], 'integer'],
            [['status'], 'string'],
            [['available_from', 'available_upto', 'created_at', 'modified_at'], 'safe'],
            [['doctor_id'], 'validateDoctorAvailability'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'doctor_id' => 'Doctor Name',
            'branch_id' => 'Branch Name',
            'available_from' => 'Available From',
            'available_upto' => 'Available Upto',
            'status' => 'Status',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
        ];
    }

    /**
     * Validate Input Doctor Availability
     *  
     * @param string $attribute doctor_id, branch_id, booking_dt
     * @param array $params
     */
    public function validateDoctorAvailability($attribute, $params)
    {
        $doctorAvailability = DoctorAvailability::find()
                ->andWhere(['BETWEEN', 'available_from', $this->available_from, $this->available_upto])
                ->orWhere(['BETWEEN', 'available_upto', $this->available_from, $this->available_upto])
                ->andWhere(['doctor_id' => $this->doctor_id, 'status' => 'Approved'])
                ->andWhere([ '!=', 'branch_id', $this->branch_id])
                // ->createCommand()->getRawSql();
                ->all();

        if(!empty($doctorAvailability)) {
            $this->addErrors([$attribute => "Doctor allready available in another branch on this dates please change dates"]);
        }
        /*
        SELECT * FROM `tbl_doctor_availability` WHERE
        (available_from BETWEEN '2020-12-21 00:00:00' AND '2020-12-21 23:55:00' ) OR(
            available_upto BETWEEN '2020-12-21 00:00:00' AND '2020-12-23 23:55:00')
        AND doctor_id = 3 AND branch_id != 6 AND status = 'Approved'
        */
        
    }

    // public function behaviors() {
    //     return [
    //         [
    //             'class' => TimestampBehavior::className(),
    //             'createdAtAttribute' => 'created_at',
    //             'updatedAtAttribute' => 'modified_at',
    //             'value' => date('Y-m-d H:i:s'),
    //         ],
    //         [
    //             'class' => BlameableBehavior::className(),
    //             'createdByAttribute' => 'created_by',
    //             'updatedByAttribute' => 'modified_by',
    //         ],
    //     ];
    // }

    // public static function getProductUploadDir() {
    //     return Yii::getAlias("@frontend/web") . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . "product-image";
    // }

    // public static function getProductDir() {
    //     return Yii::getAlias('@root') . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'product-image' . DIRECTORY_SEPARATOR;
    // }
}