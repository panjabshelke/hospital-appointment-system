<?php
$appointmentTime = [
            "Morning" => ["start" => "09", "end" => "12"], 
            "Afternoon" => ["start" => "12", "end" => "14"], 
            "Evening" => ["start" => "17", "end" => "21"]
        ];
return [
    'adminEmail' => 'admin@example.com',
    // 'supportEmail' => 'support@example.com',
    'supportEmail' => 'info@pilesfreeworld.com',  //'support@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    'user.passwordResetTokenExpire' => 3600,
    'doctors_id' => 1, // Doctors ID
    'branches_id' => 2, // Branch id
    'branchOpenTime' => '09:00:00',
    'branchCloseTime' => '21:00:00', 
    'appointmentTime' => $appointmentTime,
    'SMS_API_KEY' => "abcdefghijklmnop",
    'SMS_API_TOKEN' => "2aabcdefghijklmnop",
    'SMS_SID' => "EXOSMS",
    'FAST_SMS_API_KEY' => "eQabcdefghijklmnopabcdefghijklmnop",
    'FAST_SENDER_ID' => 'SMSINI',
    'FAST_API_URL' => 'https://www.fast2sms.com/dev/bulk',
];
