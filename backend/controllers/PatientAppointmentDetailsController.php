<?php

namespace backend\controllers;

use Yii;
use backend\models\PatientAppointmentDetails;
use backend\models\PatientAppointmentDetailsSearch;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientAppointmentDetailsController implements the CRUD actions for PatientAppointmentDetails model.
 */
class PatientAppointmentDetailsController extends Controller
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
     * Lists all PatientAppointmentDetails models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $user = new User();
        // $user->sendEmail();
        // die("end here");
        $searchModel = new PatientAppointmentDetailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PatientAppointmentDetails model.
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
     * Creates a new PatientAppointmentDetails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new PatientAppointmentDetails();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Updates an existing PatientAppointmentDetails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    // public function actionUpdate($id)
    // {
    //     $model = $this->findModel($id);

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    /**
     * Deletes an existing PatientAppointmentDetails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id); //->delete() Confirmed
        if (!empty($model) && isset($model->status) && $model->status == "Confirmed") {
            PatientAppointmentDetails::updateAll(['status' => 'Available', 'patient_name' => null, 'patient_contact_no' => null, 'booking_status' => 'No', 'patient_email' => null], 'id = ' . $id);
            $userModel = new User();
            $userModel->sendAppointmentMail($model, true);
            Yii::$app->session->setFlash('success', "Patient appointment cancelled successfully.");
        } else if (!empty($model)) {
            PatientAppointmentDetails::updateAll(['status' => 'Cancelled'], 'id = ' . $id);
            Yii::$app->session->setFlash('success', "Appointment cancelled successfully.");
        } else {
            Yii::$app->session->setFlash('error', 'Patient appointment not cancelled.');
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the PatientAppointmentDetails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PatientAppointmentDetails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PatientAppointmentDetails::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionConfirmed($id)
    {
        $model = $this->findModel($id); //->delete()
        if (!empty($model) && isset($model->status) && $model->status == 'Pending') {
            PatientAppointmentDetails::updateAll(['status' => 'Confirmed'], 'id = ' . $id);
            $userModel = new User();
            $model = $this->findModel($id);
            $userModel->sendAppointmentMail($model);
            Yii::$app->session->setFlash('success', "Patient appointment confirmed successfully.");
        } else {
            Yii::$app->session->setFlash('error', 'Patient appointment not confirmed.');
        }
        return $this->redirect(['index']);
    }
    // revert-confirm
    public function actionRevertConfirm($id)
    {
        $model = $this->findModel($id);
        if (!empty($model) && isset($model->status) && $model->status == 'Confirmed') {
            PatientAppointmentDetails::updateAll(['status' => 'Available', 'patient_contact_no' => '', 'patient_name' => '', 'patient_email' => ''], 'id = ' . $id);
            $userModel = new User();
            $userModel->sendAppointmentMail($model, true);
            //send mail to users
            Yii::$app->session->setFlash('success', "Cancelled confirmed appointment successfully.");
        } else {
            Yii::$app->session->setFlash('error', 'Patient appointment not cancelled.');
        }
        return $this->redirect(['index']);
    }

    public function actionGetAppointmentDetails()
    {
        $appointmentDetails = [];
        $status = "failed";
        if (isset($_POST['appointmentType']) && !empty($_POST['appointmentType'])) {
            $appointmentDetails = PatientAppointmentDetails::find()->alias('pad')->select(["pad.id"])
                ->andFilterWhere(['pad.status' =>$_POST['appointmentType']])
                ->asArray()
                ->one();
            if(!empty($appointmentDetails))
                $status = "success";
        }
        return json_encode(['status' => $status, 'outputdata' => $appointmentDetails]);
    }
}

