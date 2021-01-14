<?php
namespace backend\controllers;

use backend\models\CategoryMaster;
use backend\models\PatientAppointmentDetails;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Dashboard controller
 */
class DashboardController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $doctorID = Yii::$app->params['doctors_id'];
        $branchID = Yii::$app->params['branches_id'];
        $allDoctors = CategoryMaster::getParentCategories($doctorID, false);
        $allBranches = CategoryMaster::getParentCategories($branchID, false);
//'Available' => 'Available', 'Pending' => 'Pending', 'Confirmed' => 'Confirmed', 'Completed' => 'Completed', 'Cancelled' => 'Cancelled'
        $pendingAppointments = PatientAppointmentDetails::find()->where(['status' => 'Pending'])->count();
        $availableAppointments = PatientAppointmentDetails::find()->where(['status' => 'Available'])->count();
        $confirmedAppointments = PatientAppointmentDetails::find()->where(['status' => 'Confirmed'])->count();
        $completedAppointments = PatientAppointmentDetails::find()->where(['status' => 'Completed'])->count();
        $today = date('Y-m-d');
        $todayPendingAppointments = PatientAppointmentDetails::find()->where(['status' => 'Pending', 'available_date' => $today])->count();
        $todayAvailableAppointments = PatientAppointmentDetails::find()->where(['status' => 'Available', 'available_date' => $today])->count();
        $todayConfirmedAppointments = PatientAppointmentDetails::find()->where(['status' => 'Confirmed', 'available_date' => $today])->count();
        $todayCompletedAppointments = PatientAppointmentDetails::find()->where(['status' => 'Completed', 'available_date' => $today])->count();
        
        $countData = ['doctors' => count($allDoctors), 'branches' => count($allBranches), 
                      'pending' => $pendingAppointments, 'available' => $availableAppointments,
                      'confirmed' => $confirmedAppointments, 'completed' => $completedAppointments, 
                      'today-pending' => $todayPendingAppointments, 'today-available' => $todayAvailableAppointments,
                      'today-confirmed' => $todayConfirmedAppointments, 'today-completed' => $todayCompletedAppointments, 
                    ];
        return $this->render('index', ['dashboardData' => $countData]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
