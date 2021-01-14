<?php

namespace backend\controllers;

use backend\models\CategoryMaster;
use Yii;
use backend\models\PatientFollowUpDetails;
use backend\models\PatientFollowUpDetailsSearch;
use backend\models\PatientAppointmentDetails;
use backend\models\PatientAppointmentDetailsSearch;
use Exception;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientFollowUpDetailsController implements the CRUD actions for PatientFollowUpDetails model.
 */
class PatientFollowUpDetailsController extends Controller
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
     * Lists all PatientFollowUpDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PatientFollowUpDetailsSearch();
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
     * Displays a single PatientFollowUpDetails model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $contactNo)
    {
        $patientDetails = PatientFollowUpDetails::find()->alias('pfud')
                        ->select(["pfud.*", "tbl_patient_appointment_details.doctor_name", "tbl_patient_appointment_details.available_date", "tbl_patient_appointment_details.available_time_slot", "tbl_patient_appointment_details.doctor_name", "tbl_patient_appointment_details.branch_name"])
                        ->where(['pfud.patient_contact_no' => $contactNo])
                        ->innerJoin("tbl_patient_appointment_details", "tbl_patient_appointment_details.id = pfud.patient_appointemnt_details_fk") //
                        ->orderBy(['pfud.id' => SORT_DESC])->all();
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'patientDetails' => $patientDetails
        ]);
    }

    /**
     * 
     * Finds the PatientFollowUpDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PatientFollowUpDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PatientFollowUpDetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //patient-data
    public function actionPatientData() {
        $searchModel = new PatientAppointmentDetailsSearch();
        $dataProvider = $searchModel->searchFollowData(Yii::$app->request->queryParams);
        
        if (isset($_POST['export_type'])) {
            $dataProvider->pagination = false;
        }
        return $this->render('patient-data', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAdd($id) {
        $model = PatientFollowUpDetails::find()->where(['patient_appointemnt_details_fk' => $id])->one();
        if(empty($model)) {
            $model = new PatientFollowUpDetails();
        }
        $followUpDetail = PatientAppointmentDetails::find()->where(['id' => $id, 'status' => 'Confirmed'])->one();
        if(!empty($followUpDetail)) {
            $model->patient_appointemnt_details_fk = $followUpDetail->id;
            $model->patient_name = $followUpDetail->patient_name;
            $model->patient_contact_no = $followUpDetail->patient_contact_no;
            $model->patient_email = $followUpDetail->patient_email;
        }
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model->getDb()->beginTransaction();
            try {
                $model->created_at = $model->modified_at = date('Y-m-d H:i:s');
                if(empty($model->next_follow_up_date)) {
                    Yii::$app->session->setFlash('error', "Follow up date cannot be blank.");
                    return $this->render('add', [
                        'model' => $model,
                        'followUpDetail' => $followUpDetail,
                    ]);
                }
                if ($model->save()) {
                    PatientAppointmentDetails::updateAll(['status' => 'Completed'], ['id' => $model->patient_appointemnt_details_fk, 'status' => 'Confirmed']);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Patient follow up information added.");
                } else {
                    Yii::$app->session->setFlash('error', "Patient follow up information not added validation error.");
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                Yii::$app->getSession()->setFlash('danger', "Error::" . $ex->getMessage());
            }
            return $this->redirect(['patient-data']);
        }
        return $this->render('add', [
            'model' => $model,
            'followUpDetail' => $followUpDetail,
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        // $model = PatientFollowUpDetails::find()->where(['patient_appointemnt_details_fk' => $id])->one();
        // if(empty($model)) {
        //     $model = new PatientFollowUpDetails();
        // }
        $followUpDetail = PatientAppointmentDetails::find()->where(['id' => $model->patient_appointemnt_details_fk])->one();
        if(!empty($followUpDetail)) {
            $model->patient_appointemnt_details_fk = $followUpDetail->id;
            $model->patient_name = $followUpDetail->patient_name;
            $model->patient_contact_no = $followUpDetail->patient_contact_no;
            $model->patient_email = $followUpDetail->patient_email;
        }
        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model->getDb()->beginTransaction();
            try {
                $model->modified_at = date('Y-m-d H:i:s');
                if(empty($model->next_follow_up_date)) {
                    Yii::$app->session->setFlash('error', "Follow up date cannot be blank.");
                    return $this->render('add', [
                        'model' => $model,
                        'followUpDetail' => $followUpDetail,
                    ]);
                }
                if ($model->save()) {
                    // PatientAppointmentDetails::updateAll(['status' => 'Completed'], ['id' => $model->patient_appointemnt_details_fk, 'status' => 'Confirmed']);
                    $transaction->commit();
                    Yii::$app->session->setFlash('success', "Patient follow up information updated successfully.");
                } else {
                    Yii::$app->session->setFlash('error', "Patient follow up information not updated validation error.");
                }
            } catch (Exception $ex) {
                $transaction->rollback();
                Yii::$app->getSession()->setFlash('danger', "Error::" . $ex->getMessage());
            }
            return $this->redirect(['index']);
        }
        return $this->render('add', [
            'model' => $model,
            'followUpDetail' => $followUpDetail,
        ]);
    }
}
