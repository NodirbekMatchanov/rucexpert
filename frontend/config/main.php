<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru',
    'homeUrl' => '/',
    'aliases' => [
        '@mdm/admin' => '@common/modules/rbac-gui',
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'sourcePath' => null,
                    'css' => [],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'sourcePath' => null,
                    'js'=>[
                        '/new_temp/news/vendor/jquery/jquery.min.js'
                    ]
                ],
            ],
        ],
        'reCaptcha' => [
            'class' => 'himiklab\yii2\recaptcha\ReCaptchaConfig',
            'siteKeyV3' => '6LfFrc0ZAAAAACPaUOuR3n842yTAHs_FnE5SP4lP',
            'secretV3' => '6LfFrc0ZAAAAAJGFcLGRKWGI2nv5b68j0nK4N1xD',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => ""
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
             'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'demin@ruc.expert',
                'password' => 'Lion6006826407',
                'port' => '465',
                'encryption' => 'ssl',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'authClientCollection' => [
            'class' => \yii\authclient\Collection::className(),
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '599010284302815',
                    'clientSecret' => 'd90ad9b3efd00dc19df47d61e59f19da',
                    'attributeNames' => ['name', 'email', 'first_name', 'last_name'],
                ],
                'vkontakte' => [
                    'class' => 'yii\authclient\clients\VKontakte',
                    'clientId' => '6994403',
                    'clientSecret' => '0Ui9gb8WAlKGDmYNSsn3',
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '643692777731-gnrdb5o56lpc98dn1ivmjkuttpua7sav.apps.googleusercontent.com',
                    'clientSecret' => '5XBTdB1grO3Bnlf9CqUZ28fZ',
                ],
            ],
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'news' => 'news/index',
                'news/view' => 'news/view',
                'news/feed-back' => 'news/feed-back',
                'search' => 'news/search',
                'news/<url>' => 'news/rubric',
                'news/<action>' => '<controller><action>',
                'about' => 'site/about',
                '<url>' => 'site/pages',
            ],
        ],
        'robokassa' => [
            'class' => '\robokassa\Merchant',
            'baseUrl' => 'https://auth.robokassa.ru/Merchant/Index.aspx',
            'sMerchantLogin' => 'RUCEXPERT_RU',
//            'sMerchantPass1' => 'noNu3N38bTytM1adC7lt',
            'sMerchantPass1' => 'CBznhH2VCC6gCQ7ZWz16',
//            'sMerchantPass2' => 'Z12dbGUBT1hcsm7wU7WX',
            'sMerchantPass2' => 'eB3wD1mR4QkfP0vk0cCi',
            'isTest' => true,
        ]
    ],
    'params' => $params,
];
