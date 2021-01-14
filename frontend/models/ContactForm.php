<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'message'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
            'message' => 'Message',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    { 
        $messageBody = "Message: $this->message";
        return Yii::$app->mailer->compose()
            ->setTo(Yii::$app->params['adminEmail'])
            ->setCC([$this->email])
            // ->setFrom([$this->email])
            ->setFrom([Yii::$app->params['supportEmail']])
            ->setReplyTo([$this->email])
            ->setSubject(Yii::$app->params['subject'].":".$this->subject)
            ->setTextBody($messageBody)
            ->send();
        // // echo '<pre>'; print_r($email);die;
        // return Yii::$app->mailer->compose()
        //     ->setTo($email)
        //     ->setFrom([$this->email => $this->name])
        //     ->setReplyTo([$this->email => $this->name])
        //     ->setSubject(null)
        //     ->setTextBody($this->message)
        //     ->send();
     
    }
}
