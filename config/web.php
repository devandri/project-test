<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Market Place',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Jakarta',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'defaultRoute' => 'user/index',
    // 'modules' => [
    //     'admin' => [
    //         'class' => 'mdm\admin\Module',
    //         'mainLayout' => '@app/views/layouts/main.php',
    //         'layout' => 'acd-menu',
    //         'viewPath' => '@app/views/admin',
    //         'controllerMap' => [
    //             'assignment' => [
    //                 'class' => 'mdm\admin\controllers\AssignmentController',
    //                 'userClassName' => 'app\models\User',
    //                 'idField' => 'user_id',
    //                 'usernameField' => 'username',
    //             ],
    //             // 'class' => 'mdm\admin\controllers\AssignmentController',
    //             // 'userClassName' => 'app\models\User',
    //             // 'idField' => 'user_id',
    //             // 'usernameField' => 'username',
    //             // 'fullnameField' => 'profile.full_name',
    //         ],
    //         'menus' => [
    //             'assignment' => [
    //                 'label' => 'Access Assignment',
    //             ],
    //             // 'route' => null, // disable menu
    //             'route' => [
    //                 'label' => 'Access Routes',
    //             ],
    //             'permission' => [
    //                 'label' => 'Access Permission',
    //             ],
    //             'menu' => [
    //                 'label' => 'Access Menu',
    //             ],
    //             'role' => [
    //                 'label' => 'Access Roles',
    //             ],
    //             // 'role' => null,
    //             'rule' => null,
    //             'user' => null,
    //         ],
    //     ],
    // ],
    // 'as access' => [
    //     'class' => 'mdm\admin\components\AccessControl',
    //     'allowActions' => [
    //         'site/login',
    //         'site/logout',
    //         'site/login-sso',
    //         'ecollection-merchants/*',
    //         'sso-account/*',
    //         'transaction/simulator',
    //         // 'admin/*',
    //         // The actions listed here will be allowed to everyone including guests.
    //         // So, 'admin/*' should not appear here in the production, of course.
    //         // But in the earlier stages of your development, you may probably want to
    //         // add a lot of actions here until you finally completed setting up rbac,
    //         // otherwise you may not even take a first step.
    //     ],
    // ],
    'components' => [
        // 'threshold' => [
        //     'class' => 'app\components\ThresholdHelper',
        // ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'adfpRNP8fAFUGQNzmm1QLRrWC0OfFj8B',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'session' => [
            'class' => 'yii\web\DbSession',
            'db' => $db['db'],
            'sessionTable' => 'session',
            'timeout' => \cf\config::YII_ENV != 'prod' ? 1800 : 900,
        ],
        // 'user' => [
        //     'identityClass' => 'app\models\User',
        //     'loginUrl' => ['site/login'],
        //     'enableAutoLogin' => false,
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        // 'log' => [
        //     'traceLevel' => \cf\config::YII_DEBUG ? 3 : 0,
        //     'targets' => [
        //         [
        //             'except' => [
        //                 'yii\debug\Module::checkAccess',
        //             ],
        //             'class' => 'app\components\TeleLog',
        //             'levels' => ['warning'],
        //             'botToken' => \cf\config::TELEGRAM_TOKEN,
        //             'chatId' => \cf\config::TELEGRAM_TARGET,
        //         ],
        //         [
        //             'class' => 'yii\log\FileTarget',
        //             'levels' => ['error', 'warning'],
        //         ],
        //     ],
        // ],
        'db' => $db['db'],
        // 'db_switcher' => $db['db_switcher'],
        // 'db_log' => $db['db_log'],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<alias:simulator>' => 'transaction/simulator',
            ],
        ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
