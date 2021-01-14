<?php

use \yii\web\Request;

$baseUrl = str_replace('/backend/web', '/xadmin', (new Request)->getBaseUrl());
// $baseUrl = (new Request)->getBaseUrl();

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
$modules = require(__DIR__ . '/modules.php');

return [
    'id' => 'app-backend',
    'name' => 'Project Base',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => $modules,
    'aliases' => [
        '@mdm/admin' => '@backend/extensions/mdm/yii2-admin',
    ],
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            // 'site/*',
            // 'admin/*',
            // 'category-master/*',
            // 'pages-detail/*',
            // 'banner/*',
            // 'product-master/*',
            // 'testimonial/*',
            'gii/*',
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => $baseUrl,
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                   '@app/views' =>  '@backend/web/themes/admin-lte'
                //    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
                ],
                'baseUrl' => "@web/themes/admin-lte/layouts"
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-blue',
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => TRUE,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
    'defaultRoute' => 'dashboard/index',
];
