<?php

use mdm\admin\models\form\Signup;
use yii\db\Migration;

class m301120_141327_create_default_user_and_roles extends Migration {

    public function safeUp() {
        $authManager = Yii::$app->authManager;

        $guestPermission = $authManager->createPermission('guest_user');
        $guestPermission->description = "Guest user permissions";
        $authManager->add($guestPermission);

        $authUserPermission = $authManager->createPermission('authenticated_user');
        $authUserPermission->description = "Authenticated user permissions";
        $authManager->add($authUserPermission);

        $sysAdminRole = $authManager->createRole('sysadmin');
        $sysAdminRole->description = "System Administrator Role";
        $authManager->add($sysAdminRole);

        $authManager->addChild($sysAdminRole, $authUserPermission);

        $guestAllowedRoutes = [
            '/admin/user/login',
            '/admin/user/signup',
            '/admin/user/reset-password',
            '/admin/user/request-password-reset'
        ];

        $authAllowedRoutes = [
            '/admin/user/logout',
            '/admin/user/change-password',
            '/site/index'
        ];

        $sysAdminAllowedRoutes = [
            '/*'
        ];

        foreach ($guestAllowedRoutes as $route) {
            $permission = $authManager->createPermission($route);
            $authManager->add($permission);
            $authManager->addChild($guestPermission, $permission);
        }

        foreach ($authAllowedRoutes as $route) {
            $permission = $authManager->createPermission($route);
            $authManager->add($permission);
            $authManager->addChild($authUserPermission, $permission);
        }

        foreach ($sysAdminAllowedRoutes as $route) {
            $permission = $authManager->createPermission($route);
            $authManager->add($permission);
            $authManager->addChild($sysAdminRole, $permission);
        }
        
        #create sysadmin user and assign it sysadmin role
        $signupModel = new Signup();
        $signupModel->username = "sysadmin";
        $signupModel->email = "sysadmin@example.com";
        $signupModel->password = "sysadmin@123";

        $sysAdminUser = $signupModel->signup();
        $userId = $sysAdminUser->id;
        $authManager->assign($sysAdminRole, $userId);
    }

    public function safeDown() {
        echo "\nThe migration m160512_141327_create_default_user_and_roles rollback is not supported.";
    }

}
