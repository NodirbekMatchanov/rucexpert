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
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => '@frontend',
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => '@frontend',
                    'js'=>[
                        '/new_temp/news/vendor/jquery/jquery.min.js'
                    ]
                ],
            ],
        ],
        'formatter' => [
            'timeZone' => 'Europe/Moscow',
            'dateFormat' => 'd.MM.Y',
            'timeFormat' => 'H:mm:ss',
            //'datetimeFormat' => 'd.MM.Y HH:mm',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin'
            
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',
                'username' => 'group.scala@mail.ru',
                'password' => 'nodirbek199601051',
                'port' => '587',
                'encryption' => 'tls',
            ],
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
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
              /*  '<controller:(about|login)>' => 'site/index',
                '<controller:(\w|-)+>/' => '<controller>/index',
                '<controller:\w+>/<action:(\w|-)+>/<id:\d+>' => '<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<action:(\w|-)+>' => '<module>/<controller>/<action>',
                '<controller:\w+>/<action:(\w|-)+>' => '<controller>/<action>'*/
            ],
        ],

    ],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@','?'],
            'roots' => [
                'global'=>[
                    'baseUrl'=>'/',
                    'basePath'=>'@frontend',
                    'path'=>'/uploads/news/',
                    'name' => 'Global'
                ]
            ],
        ],
    ],
    'params' => $params,
];
