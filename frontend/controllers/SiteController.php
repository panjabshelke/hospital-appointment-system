<?php

namespace frontend\controllers;

use backend\models\CategoryMaster;
use backend\models\DoctorAvailability;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\PatientAppointmentDetails;
use backend\models\PatientFollowUpDetails;
use common\models\User;
use yii\helpers\ArrayHelper;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new PatientFollowUpDetails();
        $doctorID = Yii::$app->params['doctors_id'];
        $branchID = Yii::$app->params['branches_id'];
        $allDoctors = CategoryMaster::getParentCategories($doctorID, false);
        $allBranches = CategoryMaster::getParentCategories($branchID, false);
        $activeDoctors = ArrayHelper::map($allDoctors, 'id', 'category_name');
        $activeBranches = ArrayHelper::map($allBranches, 'id', 'category_name');
        $statusChk = "";

        if ($model->load(Yii::$app->request->post())) {
            $timeSlot = Yii::$app->request->post('book-time-slot');
            $reservationDate = Yii::$app->request->post('reservationDate');
            $reservationDate = date('Y-m-d', strtotime($reservationDate));
            $patientFollowUpDetails = Yii::$app->request->post('PatientFollowUpDetails');
            $model->doctor_name = $patientFollowUpDetails['doctor_name'];
            $model->branch_name = $patientFollowUpDetails['branch_name'];


            $findTimeSlot = PatientAppointmentDetails::find()
                ->where([
                    'id' => $timeSlot, 'available_date' => $reservationDate,
                    'branch_id' => $model->branch_name, 'doctor_id' => $model->doctor_name, 'status' => 'Available'
                ])->one();
            if (!empty($findTimeSlot)) {
                $findTimeSlot->patient_name = $model->patient_name;
                $findTimeSlot->patient_email = $model->patient_email;
                $findTimeSlot->patient_contact_no = $model->patient_contact_no;
                $findTimeSlot->booking_status = 'Yes';
                $findTimeSlot->appointment_category = 'First visit';
                $findTimeSlot->status = 'Pending'; // Confirmed
                if ($findTimeSlot->save()) {
                    $userModel = new User();
                    $userModel->sendAppointmentMail($findTimeSlot);
                    $statusChk = "Success";
                    return $this->redirect(['thank-you']);
                } else {
                    $statusChk = 'error-First';
                }
                $model = new PatientFollowUpDetails();
            } else {
                $statusChk = 'error-First';
                Yii::$app->session->setFlash('error', 'This time slot not booked, try again after some time.');
            }
            return $this->redirect(['index']);
        } else if (Yii::$app->request->post()) {
            $model->patient_name = Yii::$app->request->post('patient_name');
            $model->patient_email = Yii::$app->request->post('patient_email');
            $model->patient_contact_no = Yii::$app->request->post('patient_contact_no');

            $model->branch_name = Yii::$app->request->post('branch_name');
            $model->doctor_name = Yii::$app->request->post('doctor_name');

            $timeSlot = Yii::$app->request->post('book-time-slot');
            $reservationDate = Yii::$app->request->post('reservationDatePopup');
            $reservationDate = date('Y-m-d', strtotime($reservationDate));

            $findTimeSlot = PatientAppointmentDetails::find()
                ->where([
                    'id' => $timeSlot, 'available_date' => $reservationDate,
                    'branch_id' => $model->branch_name, 'doctor_id' => $model->doctor_name, 'status' => 'Available'
                ])->one();

            if (!empty($findTimeSlot)) {
                $findTimeSlot->patient_name = $model->patient_name;
                $findTimeSlot->patient_email = $model->patient_email;
                $findTimeSlot->patient_contact_no = $model->patient_contact_no;
                $findTimeSlot->booking_status = 'Yes';
                $findTimeSlot->appointment_category = 'First visit';
                $findTimeSlot->status = 'Pending'; // Confirmed
                if ($findTimeSlot->save()) {
                    $statusChk = "Success";
                    $userModel = new User();
                    $userModel->sendAppointmentMail($findTimeSlot);
                    $statusChk = "Success";
                    return $this->redirect(['thank-you']);
                } else {
                    $statusChk = 'error-First';
                }
                $model = new PatientFollowUpDetails();
            } else {
                $statusChk = 'error-First';
                Yii::$app->session->setFlash('error', 'This time slot not booked, try again after some time.');
            }
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model,
            'activeBranches' => $activeBranches,
            'activeDoctors' => $activeDoctors,
            'statusChk' => $statusChk,
        ]);
    }

    public function actionCollectAvailableSlots()
    {
        /*
        $branch_id = 5;
        $doctor_id = 3;
        echo $reservationDate = date('Y-m-d', strtotime("29-01-2021"));
        $branchOpenTime = Yii::$app->params['branchOpenTime'];
        $appointmentTime = Yii::$app->params['appointmentTime'];
        // $reservationDate 
        echo "Start time :: " . $createStartTime = $reservationDate . " " . $branchOpenTime;
        

        $command = Yii::$app->getDb();
        $sql = 'SELECT * FROM `tbl_doctor_availability` 
                WHERE ( "' . $createStartTime . '" BETWEEN `available_from` AND `available_upto`) 
                AND   (`available_upto` > "' . $createStartTime . '") AND `status` = "Approved"';

        $doctorDetails = $command->createCommand($sql)->queryOne();
        if (!empty($doctorDetails)) {
            $id = $doctorDetails['id'];
            $availableUpto = $doctorDetails['available_upto'];
            $endDate = $reservationDate . " 23:00:00";
            if (strtotime(date('Y-m-d', strtotime($availableUpto))) == strtotime($reservationDate)) {
                $endDate = $availableUpto;
            }
            $startDate = $reservationDate . " " . $appointmentTime['Morning']['start'] . ":00:00";
            $appointmentSlotDetails =  PatientAppointmentDetails::splitTime($startDate, $endDate, 20);
            // splitTime($available_from, $available_upto, "20");
            $bookedAppointmentDetails = PatientAppointmentDetails::find()
                ->where(['doctor_availability_id' => $id, 'status' => ['Pending', 'Confirmed', 'Completed']])
                ->andWhere(['available_date' => $reservationDate])
                ->all();
            $availableTimeSlot = [];
            foreach ($appointmentSlotDetails as $bookedData) {
                foreach ($bookedData as $slot_type => $slotTimeData) {
                    foreach ($slotTimeData as $available_time_slot) {
                        if (!empty($available_time_slot)) {
                            $availableTimeSlot[$available_time_slot] = $available_time_slot;
                        }
                    }
                }
            }
            if (!empty($availableTimeSlot)) {
                foreach ($bookedAppointmentDetails as $bookedAppointmentData) {
                    //available_time_slot
                    if (isset($availableTimeSlot[$bookedAppointmentData['available_time_slot']]))
                        unset($availableTimeSlot[$bookedAppointmentData['available_time_slot']]);
                }
            }
        }
        // doctor_availability_id
        print_r($doctorDetails);
        die;
        */
        $status = 'failed';
        $availableTimeSlots = [];
        if ((isset($_POST['branch_id']) && !empty($_POST['branch_id'])) && (isset($_POST['reservationDate']) && !empty($_POST['reservationDate'])) && isset($_POST['doctor_id']) && !empty($_POST['doctor_id'])) {
            $branch_id = $_POST['branch_id'];
            $doctor_id = $_POST['doctor_id'];
            $reservationDate = date('Y-m-d', strtotime($_POST['reservationDate']));
            //branch_id doctor_id available_date
            $findAvailableSlots = PatientAppointmentDetails::find()
                ->where(['branch_id' => $branch_id, 'doctor_id' => $doctor_id, 'available_date' => $reservationDate])
                ->andWhere(['!=', 'status', 'Cancelled'])
                ->all();
            //->andWhere([ '!=', 'branch_id', $this->branch_id])
            if (!empty($findAvailableSlots)) {
                foreach ($findAvailableSlots as $availableDetail) {
                    $availableTimeSlots[] = ['id' => $availableDetail->id, 'slot_time' => $availableDetail->available_time_slot, 'booking_status' => $availableDetail->booking_status];
                }
                $status = "success";
            }
        }
        return json_encode(['status' => $status, 'outputdata' => $availableTimeSlots]);
    }
    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about', []);
    }

    /**
     * Displays specifications page.
     *
     * @return mixed
     */
    public function actionOurSpecifications()
    {
        return $this->render('our-specifications', []);
    }

    /**
     * Displays Branches page.
     *
     * @return mixed
     */
    public function actionOurBranches()
    {
        return $this->render('our-branches', []);
    }

    /**
     * Displays Gallery page.
     *
     * @return mixed
     */
    public function actionOurGallery()
    {
        return $this->render('our-gallery', []);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionThankYou()
    {
        return $this->render('thank-you', []);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
