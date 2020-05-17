<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'language' => 'ru',
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                ],
            ],
            'mainLayout' => '@app/views/layouts/main.php',
        ]
    ],
    'aliases' => [
        '@mdm/admin' => '@common/modules/rbac-gui',
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:(about|login)>' => 'site/index',
                '<controller:(\w|-)+>/' => '<controller>/index',
                '<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>'
            ],
        ],*/

    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@','?'],
            'roots' => [
                'global'=>[
                    'baseUrl'=>'/backend',
                    'basePath'=>'@backend',
                    'path'=>'web/uploads/news/',
                    'name' => 'Global'
                ]
            ],
        ],
    ],
    'params' => $params,
];
