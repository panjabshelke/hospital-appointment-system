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
];
