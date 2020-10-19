<?php

namespace frontend\controllers;

use backend\components\Sender;
use backend\models\News;
use backend\models\Pages;
use common\models\BlackList;
use common\models\Sms;
use common\models\User;
use frontend\components\Helper;
use frontend\models\FastSignupForm;
use Yii;
use yii\authclient\AuthAction;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\log\Logger;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'send-code'],
                'rules' => [
                    [
                        'actions' => ['signup', 'send-code'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => AuthAction::class,
                'successCallback' => [$this, 'successCallback']
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $loginModel = new LoginForm();
        $signModel = new SignupForm();
        $contactModel = new ContactForm();
        $newsList = News::getNewsGroupByRubric();
        $homePage = Pages::find()->where(['url' => 'home'])->one();
        $count = BlackList::find()->count();
        return $this->render('index', [
            "newsList" => $newsList,
            "count" => $count,
            "model" => $loginModel,
            "signModel" => $signModel,
            "contact" => $contactModel,
            "homePage" => $homePage
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $signModel = new SignupForm();
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['personal-area/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['personal-area/index']);
        } else {
            if (Yii::$app->request->isAjax) {

                return $this->renderAjax('login', [
                    'model' => $model,
                    "signModel" => $signModel,
                ]);
            } else {
                return $this->render('login', [
                    'model' => $model,
                    "signModel" => $signModel,
                ]);
            }
        }
//        } else {
//            return $this->redirect(['index']);
//        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if (Yii::$app->request->isAjax) {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendEmail()) {
                    Yii::$app->session->setFlash('success', 'Благодарим вас за обращение к нам. Мы ответим вам как можно скорее.');
                } else {
                    Yii::$app->session->setFlash('error', 'При отправке вашего сообщения произошла ошибка.');
                }
                echo $this->renderAjax('contact', [
                    'model' => $model,
                ]);
                exit();
            } else {
                echo $this->renderAjax('contact', [
                    'model' => $model,
                ]);
                exit();
            }
        } else {
            return $this->redirect('index');
        }

    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['personal-area/index', 'new-user' => true]);
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);

    }

    /**
     * Fast Signs user up.
     *
     * @return mixed
     */
    public function actionFastSignup()
    {
        $model = new FastSignupForm();

        if (Yii::$app->request->isAjax && Yii::$app->request->get()) {
            $model->email = Yii::$app->request->get('email');
            $model->phone = Helper::formatPhone(Yii::$app->request->get('phone'));
            $model->code = '';
            $this->actionSendCode();
            return $this->renderAjax('fast_signup', [
                'model' => $model,
            ]);
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect(['personal-area/index', 'new-user' => true]);
                }
            } else {
                return false;
            }
        }

    }

    public function actionPages($url)
    {
        $page = Pages::find()->where(['url' => $url])->one();
        return $this->render('page', [
            'page' => $page
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'К сожалению, мы не можем сбросить пароль для указанного адреса электронной почты.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionSendCode()
    {

        if (Yii::$app->request->isAjax) {
            $phone = Yii::$app->request->get('phone');
            $code = rand(1000, 9999);
            $sms = new Sms();
            $sms->code = $code;
            $sms->phone = Helper::formatPhone($phone);
            $sms->create_at = date("Y-m-d h:i:s");
            if ($sms->save()) {
                $messages = new Sender(Yii::$app->params['sms_login'], Yii::$app->params['sms_passwd']);
                $messages = $messages->messageObj;
                $messages->setUrl(Yii::$app->params['sms_host']);
                $mes = $messages->createNewMessage(Yii::$app->params['sms_sender'], $code, 'sms');

                $abonent = $mes->createAbonent($sms->phone);
                $abonent->setNumberSms(1);
                $mes->addAbonent($abonent);
                //$abonent->setTimeSend("2015-12-15 15:12");
                //$abonent->setValidityPeriod("2015-12-16 16:00");
                $mes->addAbonent($abonent);
                $messages->addMessage($mes);
                if (!$messages->send()) {
                    Yii::info($messages->getError());
                    return false;
                } else {
                    Yii::info(($messages->getResponse()));
                    return true;
                }
            } else {
                return false;
            }
        }
    }


    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $access_token = $client->getAccessToken()->getToken();
        $id = ArrayHelper::getValue($attributes, 'id');
        $socialName = $client->getName();
        if ($socialName === 'facebook') {
            $auth = User::find()->where(['facebook_id' => $id])->one();
        }
        if ($socialName === 'vkontakte') {
            $auth = User::find()->where(['vkontakte_id' => $id])->one();
        }
        if ($socialName === 'google') {
            $auth = User::find()->where(['google_id' => $id])->one();
        }
        if (Yii::$app->user->isGuest && !empty($auth)) {
            if (Yii::$app->user->login($auth)) { // login
                return $this->redirect(['personal-area/index']);
            } else {
                $auth->addError('ошибка при входе');
            }
        } else {
            $auth->addError("facebook_id", 'ошибка при входе');
        }
    }
}
