<?php
namespace common\models;

use Yii;
use Swift_TransportException;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function sendEmail() { //$data
        $contactUs = "panjabrshelke@gamil.com";
        // $contactUs = Configuration::findOne(Configuration::CONTACT_US_EMAIL);
        try {
            $html = "Hi,<br><br> Test mail";
            $message = $html . "<br>";
            $response = Yii::$app
                    ->mailer
                    /* ->compose(
                      ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user]
                      ) */
                    ->compose()
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($contactUs)
                    ->setSubject('Hospital Appointment: Contact Us')
                    ->setHtmlBody($message)
                    ->send();
                    
        } catch (Swift_TransportException $e) {
            $response = $e->getMessage();
        }
        echo "<pre>";
            print_r($response);
        return $response;
    }

    public function sendEmailTest() {
        // $contactUs = \backend\models\Configuration::findOne(\backend\models\Configuration::CONTACT_US_EMAIL);
        // $custmer = \common\models\Customer::findOne($this->customer_id);
        try {
            $message = "Hi Admin,<br><br>We have received a order from <b>{$custmer->first_name} {$custmer->last_name}. </b>";
            $response = Yii::$app
                    ->mailer
                    /* ->compose(
                      ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'], ['user' => $user]
                      ) */
                    ->compose()
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($contactUs->value)
                    ->setSubject('Urushya: Order received from ' . $custmer->first_name)
                    ->setHtmlBody($message)
                    ->send();
        } catch (Swift_TransportException $e) {
            $response = $e->getMessage();
        }
        return $response;
    }

    public function sendAppointmentMail($availabilityChk, $cancleAppointment = false) {
        $status = false;
        if (!empty($availabilityChk)) {
            if($cancleAppointment) {
                $availabilityChk->status = "Appointment Canceled";
            }
            $message = "
            Hello,
            <br/><br/>
            Below are your appointment details.
            <br/>
            <b>Patient Name</b> : {$availabilityChk->patient_name} <br/>
            <b>Contact No</b>   : {$availabilityChk->patient_contact_no} <br/>
            <b>Appointment Date</b> : {$availabilityChk->available_date} <br/>
            <b>Slot Time</b> : {$availabilityChk->available_time_slot} <br/>
            <b>Status</b> : {$availabilityChk->status} <br/>
            ";
            $userEmail = $availabilityChk->patient_email;
            $subject = 'Piles Free World Hospitals: Appoint Booking Status : ' . $availabilityChk->status;
            $response = Yii::$app
                    ->mailer
                    ->compose()
                    ->setFrom(Yii::$app->params['supportEmail'])
                    ->setTo($userEmail)
                    ->setSubject($subject)
                    ->setHtmlBody($message)
                    ->send();
            if($response)
                $status = true;
        } 
        return $status;
    }
}
