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
            $message = '<!DOCTYPE html>
            <html>
            <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="x-apple-disable-message-reformatting">
            <title></title>
            <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700,700i" rel="stylesheet">
            </head>
            <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #ffffff; font-family:Arial, Helvetica, sans-serif;">
            <center style="width: 100%; background-color: #f1f1f1;">
              <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;"> &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp; </div>
              <div style="max-width: 600px; margin: 0 auto;" class="email-container">
                <!-- BEGIN BODY -->
                <table align="center" cellspacing="0" cellpadding="0" border="0" width="100%" align="center" style="margin: auto; background:#ffffff">
                <tr>
                  <td class="bg_white logo" style="text-align: center">
                  <table  align="center" >
                      <tr>
                        <td><h1  style="margin:5px;"><a href="#"><span> <img  src="http://pilesfreeworld.com/img/logo.png" alt="" style="width: 60px; max-width: 600px; height: auto; margin: auto; display: block;"></span></a></h1></td>
                        <td><span style="    margin-top: 3px;
                text-transform: uppercase;
                font-size: 15px;
                font-weight: bold;
                color: black;"> PILES FREE</span><span style="    font-size: 15px;
                font-weight: bold;
                color: #0984a0;
                text-transform: uppercase;
                margin-top: 3px;"> WORLD HOSPITALS</span></td>
                      
                      </tr>
                    </table></td>
                </tr>
                <!-- end tr -->
                <tr>
                  <td valign="middle" class="hero" style="background-image: url(http://pilesfreeworld.com/img/banner1.jpg);    background-size: 100%;
                height: 200px;
                background-position: center;
                background-repeat: no-repeat;
                width: 100%;"><table  align="center" >
                      <tr>
                        <td style="color:#0984a0; font-size:25px;background: rgba(255,255,255,.7);"><p style="margin:0px;">Thanks for choosing</p>
                          <p style="margin:0px;"> Pilesfree World Hospitals.</p></td>
                      </tr>
                    </table></td>
                </tr>
                <!-- end tr -->
                <tr>
                  <td class="bg_white"><table role="presentation" cellspacing="0" cellpadding="10" border="0" width="100%">
                      <tr>
                        <td  style="text-align:center;font-family: sans-serif;    font-size: 17px;
                color: #4f4f4f;
                margin-top: 0;
                font-weight: normal;">
                        ';
                        if($availabilityChk->status == "Pending") {
                            $message .= '<p style="margin:0px">Your Appointment Request has been received. </p>
                          <p  style="margin:0px">Our executive will call you on registered number to confirm your appointment. </p></td>';
                        }
                        $message .= '</tr>
                      <!-- end: tr -->
                      <tr>
                        <td style=" background:#ffffff" align="center"><span  style="margin-bottom: 20px !important;
                display: inline-block;
                font-size: 15px;
                text-transform: uppercase;
                border-bottom: #42b8d3 2px solid;
                letter-spacing: 1px;
                color: rgb(107 108 108);
                position: relative;">We have received the following details :</span>
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
                            <tr>
                              <td width="5%"></td>
                              <td valign="top"><table role="presentation" cellspacing="0" cellpadding="7" border="1" width="100%"   bordercolor="#CCCCCC" style="color:#6c6b6b">
                                  <tr>
                                    <td style="text-align:right; font-weight:bold" width="30%"> Name : </td>
                                    <td> '.$availabilityChk->patient_name.'</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:right; font-weight:bold"> Email Address: </td>
                                    <td>'.$availabilityChk->patient_email.'</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:right; font-weight:bold"> Phone Number: </td>
                                    <td>'.$availabilityChk->patient_contact_no.'</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:right; font-weight:bold"> Branch: </td>
                                    <td>'.$availabilityChk->branch_name.'</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:right; font-weight:bold"> Doctor: </td>
                                    <td>'.$availabilityChk->doctor_name.'</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:right; font-weight:bold"> Appointment Date: </td>
                                    <td>'.$availabilityChk->available_date.'</td>
                                  </tr>
                                  <tr>
                                    <td style="text-align:right; font-weight:bold"> Appointment Time: </td>
                                    <td>'.$availabilityChk->available_time_slot.'</td>
                                  </tr>
                                </table></td>
                              <td width="5%"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <!-- end: tr -->
                    </table></td>
                </tr>
                <!-- end:tr -->
            </table>
                <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
                  <tr>
                    <td valign="middle" style="background:#ffffff"><table  align="center">
                        <tr>
                          <td valign="top" style="padding: 20px;">
                          <table role="presentation" cellspacing="0" cellpadding="5" border="0" width="100%" style="color:#6c6b6b; ">
                              <tr>
                                <td style="text-align: left; padding-left: 5px; padding-right: 5px;font-size:12px;  border-top:2px dotted #ccc">
                                <h3>Address :</h3>
                                
                                  2 Plot No. P.A.P. / G. /60,
                                      Thermax Chowk, Behind Kasturi Market,
                                      Majjid Road, Sambhaji Nagar,
                                      Chinchwad, Pune - 411019.
                                 </td>
                              </tr>
                              <tr>
                                <td valign="middle" style="background:#ffffff" >
                                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                                          <tr>
                                            <td style="text-align: left; font-size:12px;" align="center"><p  style="margin:0px;"><strong>Call:</strong> +91 9112675901 / 7038569384</p></td>
                                            <td style="text-align: right; font-size:12px;" align="center"><p  style="margin:0px;"><strong> Email : </strong> info@pilesfreeworld.com</p></td>
                                          </tr>
                                        </table></td>
                        </tr>
                      </table></td>
                  </tr>
                  <!-- end: tr -->
                  <tr>
                    <td align="center"  bgcolor="#0984a0" valign="middle" style="color:#fff; padding:10px; font-size:12px">&copy; pilesfreeworld 2021</td>
                  </tr>
                </table>
              </div>
            </center>
            </body>
            </html>';
            
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
