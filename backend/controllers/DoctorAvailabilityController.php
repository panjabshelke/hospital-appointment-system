<?php

namespace backend\controllers;

use backend\models\CategoryMaster;
use Yii;
use backend\models\DoctorAvailability;
use backend\models\DoctorAvailabilitySearch;
use backend\models\PatientAppointmentDetails;
use common\models\User;
use Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\filters\VerbFilter;

/**
 * DoctorAvailabilityController implements the CRUD actions for DoctorAvailability model.
 * 
 */
class DoctorAvailabilityController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DoctorAvailability models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DoctorAvailabilitySearch();
        $searchModel->status = 'Approved';
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (isset($_POST['export_type'])) {
            $dataProvider->pagination = false;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DoctorAvailability model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DoctorAvailability model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DoctorAvailability();
        $doctorID = Yii::$app->params['doctors_id'];
        $branchID = Yii::$app->params['branches_id'];
        $allDoctors = CategoryMaster::getParentCategories($doctorID, false);
        $allBranches = CategoryMaster::getParentCategories($branchID, false);

        $activeDoctors = ArrayHelper::map($allDoctors, 'id', 'category_name');
        $activeBranches = ArrayHelper::map($allBranches, 'id', 'category_name');
        // $model->available_from = date("M d, Y  H:i:s A", strtotime(date('d-m-Y') . ' + 1 days'));
        // $model->available_upto = date("M d, Y  H:i:s A", strtotime(date('d-m-Y') . ' + 3 days'));
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model->getDb()->beginTransaction();
            try {
                if (!empty($model->available_from))
                    $model->available_from = date('Y-m-d H:i:s', strtotime($model->available_from));
                if (!empty($model->available_upto))
                    $model->available_upto = date('Y-m-d H:i:s', strtotime($model->available_upto));
                
                if ($model->save()) {
                    PatientAppointmentDetails::updateAppointmentDetails(Yii::$app->request->post('DoctorAvailability'), $model->id);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Doctor availablity information added.");
                    return $this->redirect(['index']);
                } else {
                    Yii::$app->session->setFlash('error', "Doctor availablity information not added validation error.");
                }
                Yii::$app->session->setFlash('error', "Doctor availablity information not added.");
            } catch (Exception $ex) {
                $transaction->rollback();
                Yii::$app->getSession()->setFlash('danger', "Error::" . $ex->getMessage());
            }
        }
        // $categoryStatus = DoctorAvailability::DOCTOR_AVAILABILITY_STATUS;
        return $this->render('create', [
            'model' => $model,
            'activeDoctors' => $activeDoctors,
            'activeBranches' => $activeBranches,
        ]);
    }

    /**
     * Updates an existing DoctorAvailability model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // $model = $this->findModel($id);
        // $activePages = DoctorAvailability::getActivePages();
        // $activePages = ArrayHelper::map($activePages,'category_name','category_name');
        // if ($model->load(Yii::$app->request->post())) {
        //     $file = UploadedFile::getInstance($model, 'page_image');
        //     if (!empty($file)) {
        //         // image
        //         $tempFileName = $model->title . '-' . time();
        //         $prodImageTitle = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $tempFileName));
        //         $model->page_image = $prodImageTitle . "." . $file->getExtension();
        //         FileHelper::createDirectory(DoctorAvailability::getPagesUploadDir(), 0777, true);
        //         if (file_exists(DoctorAvailability::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image)) {
        //             unlink(DoctorAvailability::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image);
        //         }
        //         $file->saveAs(DoctorAvailability::getPagesUploadDir() . DIRECTORY_SEPARATOR . $model->page_image);
        //     } else {
        //         unset($model->page_image);
        //     }
        //     $model->updated_by = Yii::$app->user->identity->id;
        //     $model->updated_at = date('Y-m-d H:i:s');
        //     if ( $model->save() ) {
        //         Yii::$app->session->setFlash('success', "Page detail updated successfully.");
        //         return $this->redirect(['view', 'id' => $model->id]);
        //     }
        //     Yii::$app->session->setFlash('error', "Page detail not added.");
        // }
        // $categoryStatus = DoctorAvailability::CATEGORY_STATUS;
        // return $this->render('update', [
        //     'model' => $model,
        //     'activePages' => $activePages,
        //     'categoryStatus' => $categoryStatus,
        // ]);
    }

    /**
     * Deletes an existing DoctorAvailability model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $transaction = $model->getDb()->beginTransaction();
        try {
            if (!empty($model)) {
                $appointmentBokingDetails = PatientAppointmentDetails::find()->where(['doctor_availability_id' => $id])
                    ->andWhere(['status' => ['Confirmed', 'Pending']])
                    ->all();
                $model->status = 'Cancelled';
                if (empty($appointmentBokingDetails)) {
                    if ($model->save()) {
                        PatientAppointmentDetails::updateAll(['status' => 'Cancelled'], 'doctor_availability_id = ' . $id);
                        $transaction->commit();
                        Yii::$app->session->setFlash('success', "Doctor availability cancelled successfully.");
                    } else {
                        Yii::$app->session->setFlash('error', 'Doctor availability not cancelled.');
                    }
                } else {
                    Yii::$app->session->setFlash('error', 'Some appointments are booked from this slots.');
                }
            }
        } catch (Exception $ex) {
            $transaction->rollback();
            Yii::$app->getSession()->setFlash('danger', "Error::" . $ex->getMessage());
        }
        return $this->redirect(['index']);
    }

    public function actionBookAppointment()
    {
        $model = new PatientAppointmentDetails();
        // $doctorID = Yii::$app->params['doctors_id'];
        // $branchID = Yii::$app->params['branches_id'];
        // $allDoctors = CategoryMaster::getParentCategories($doctorID, false);
        // $allBranches = CategoryMaster::getParentCategories($branchID, false);
        // $activeDoctors = ArrayHelper::map($allDoctors, 'id', 'category_name');
        // $activeBranches = ArrayHelper::map($allBranches, 'id', 'category_name');
        $activeDoctors = $activeBranches = [];

        $todayDate = date('Y-m-d');
        $lastDate = date('Y-m-d', strtotime($todayDate . ' + 30 day'));
        $availableDates = PatientAppointmentDetails::getDatesFromRange($todayDate, $lastDate, "M d, Y");

        if (Yii::$app->request->post()) {
            $saveFormDetails = Yii::$app->request->post('PatientAppointmentDetails');
            $patientAppointDetailId =  $saveFormDetails['available_time_slot'];
            unset($saveFormDetails['available_date']);
            unset($saveFormDetails['branch_id']);
            unset($saveFormDetails['doctor_id']);
            unset($saveFormDetails['available_time_slot']);

            $availabilityChk = PatientAppointmentDetails::find()->where(['id' => $patientAppointDetailId])->one();
            if (!empty($availabilityChk)) {
                if ($availabilityChk->status == 'Cancelled') {
                    Yii::$app->session->setFlash('error', 'This time slot cancelled.');
                    return $this->render('book-appointment', [
                        'model' => $model,
                        'activeDoctors' => $activeDoctors,
                        'activeBranches' => $activeBranches,
                        'availableDates' => $availableDates,
                    ]);
                }
                $availabilityChk->setAttributes($saveFormDetails);
                $availabilityChk->booking_status = 'Yes';
                if ($availabilityChk->save()) {
                    $userModel = new User();
                    $userModel->sendAppointmentMail($availabilityChk);
                    Yii::$app->session->setFlash('success', "Time slot successfully booked.");
                } else {
                    Yii::$app->session->setFlash('error', 'This time slot not booked, try again after some time.');
                }
            } else {
                Yii::$app->session->setFlash('error', 'Time slot not selected, try again after some time.');
            }
        }
        $model->status = "Confirmed";
        $model->appointment_category = "First visit";
        return $this->render('book-appointment', [
            'model' => $model,
            'activeDoctors' => $activeDoctors,
            'activeBranches' => $activeBranches,
            'availableDates' => $availableDates,
        ]);
    }

    /**
     * 
     * Finds the DoctorAvailability model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DoctorAvailability the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DoctorAvailability::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //collect-available-slots availableDate
    public function actionCollectAvailableSlots()
    {
        $activeBranches = [];
        $status = "failed";
        if (isset($_POST['availableDate']) && !empty($_POST['availableDate'])) {
            $branchDetails = PatientAppointmentDetails::find()->alias('pad')->select(["pad.branch_id", CategoryMaster::tableName() . ".category_name as branch_name"])
                ->innerJoin(CategoryMaster::tableName(), CategoryMaster::tableName() . ".id = pad.branch_id")
                ->andFilterWhere(['pad.status' => ['Available','Pending','Confirmed','Completed']])
                ->andFilterWhere(['pad.available_date' =>$_POST['availableDate']])
                // ->andFilterWhere(['>=', 'da.available_upto', $_POST['availableDate']])
                // ->andWhere(['da.status' => 'Approved'])
                ->groupBy(['pad.doctor_availability_id'])
                ->all();
            /*
SELECT
    *
FROM 
    tbl_patient_appointment_details AS pad
INNER JOIN
    tbl_category_master AS cm
ON
    cm.id = pad.branch_id
WHERE
    pad.status IN ('Available','Pending','Confirmed','Completed') AND pad.available_date = '2020-12-24'
GROUP BY
    pad.doctor_availability_id
            */
            
            if (!empty($branchDetails)) {
                $activeBranches = ArrayHelper::map($branchDetails, 'branch_id', 'branch_name');
                $status = "success";
            }
            // print_r($activeBranches);
        } else if ((isset($_POST['selectedDoctor']) && !empty($_POST['selectedDoctor'])) && (isset($_POST['selectedBranch']) && !empty($_POST['selectedBranch'])) && (isset($_POST['selectedDate']) && !empty($_POST['selectedDate']))) {
            $availableSlotDetails = PatientAppointmentDetails::find()->alias('pad')->select(['pad.id', 'pad.available_time_slot', 'pad.booking_status'])
                ->innerJoin(CategoryMaster::tableName(), CategoryMaster::tableName() . ".id = pad.branch_id")
                ->andFilterWhere(['pad.status' => ['Available','Pending','Confirmed','Completed']])
                ->andFilterWhere(['pad.available_date' =>$_POST['selectedDate']])
                ->andFilterWhere(['pad.branch_id' => $_POST['selectedBranch'], 'pad.doctor_id' => $_POST['selectedDoctor']])
                // ->groupBy(['pad.doctor_availability_id'])
                ->all();
            // $availableSlotDetails = PatientAppointmentDetails::find()->alias('pad')->select(['pad.id', 'pad.available_time_slot', 'pad.booking_status'])
            //     ->innerJoin(DoctorAvailability::tableName(), DoctorAvailability::tableName() . ".id = pad.doctor_availability_id")
            //     ->andWhere([DoctorAvailability::tableName() . '.status' => 'Approved']) //, 'pad.booking_status' => 'No'
            //     ->andWhere([DoctorAvailability::tableName() . '.branch_id' => $_POST['selectedBranch'], DoctorAvailability::tableName() . '.doctor_id' => $_POST['selectedDoctor']])
            //     ->andWhere(['pad.available_date' => $_POST['selectedDate']])
            //     ->all();

            if (!empty($availableSlotDetails)) {
                foreach ($availableSlotDetails as $availableDetail) {
                    $activeBranches[] = ['id' => $availableDetail->id, 'slot_time' => $availableDetail->available_time_slot, 'booking_status' => $availableDetail->booking_status];
                }
                // $activeBranches = ArrayHelper::map($availableSlotDetails,'id','available_time_slot');
                $status = "success";
            }
        } else if ((isset($_POST['selectedBranch']) && !empty($_POST['selectedBranch'])) && (isset($_POST['selectedDate']) && !empty($_POST['selectedDate']))) {
            $branchDetails = PatientAppointmentDetails::find()->alias('pad')->select(["pad.doctor_id", CategoryMaster::tableName() . ".category_name as doctor_name"])
                ->innerJoin(CategoryMaster::tableName(), CategoryMaster::tableName() . ".id = pad.doctor_id")
                ->andFilterWhere(['pad.status' => ['Available','Pending','Confirmed','Completed']])
                ->andFilterWhere(['pad.available_date' =>$_POST['selectedDate']])
                ->andWhere(['pad.branch_id' => $_POST['selectedBranch']])
                ->groupBy(['pad.doctor_availability_id'])
                ->all();
            // $branchDetails = DoctorAvailability::find()->alias('da')->select(["da.doctor_id", CategoryMaster::tableName() . ".category_name as doctor_name"])
            //     ->innerJoin(CategoryMaster::tableName(), CategoryMaster::tableName() . ".id = da.doctor_id")
            //     ->andFilterWhere(['<=', 'da.available_from', $_POST['selectedDate']])
            //     ->andFilterWhere(['>=', 'da.available_upto', $_POST['selectedDate']])
            //     ->andWhere(['da.status' => 'Approved'])
            //     ->andWhere(['da.branch_id' => $_POST['selectedBranch']])
            //     ->all();

            if (!empty($branchDetails)) {
                $activeBranches = ArrayHelper::map($branchDetails, 'doctor_id', 'doctor_name');
                $status = "success";
            }
        }

        return json_encode(['status' => $status, 'outputdata' => $activeBranches]);
        // $availableDate
        // print_r($_POST);

    }
}
