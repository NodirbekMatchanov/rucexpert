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
