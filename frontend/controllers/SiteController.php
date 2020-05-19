<?php

namespace frontend\controllers;

use backend\components\Sender;
use backend\models\News;
use common\models\Sms;
use common\models\User;
use Yii;
use yii\authclient\AuthAction;
use yii\base\InvalidParamException;
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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup','send-code'],
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
                    'logout' => ['post'],
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
        $news = new News();
        $newsList = $news::find()->orderBy('id desc')->limit(3)->all();
        return $this->render('index', [
            "news" => $newsList
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['personal-area/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['personal-area/index']);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
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
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
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
                    return $this->redirect(['personal-area/index']);
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
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
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
            Yii::$app->session->setFlash('success', 'New password saved.');

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
            $sms->phone = $phone;
            $sms->create_at = date("Y-m-d h:i:s");
            if ($sms->save()) {
                $messages = new Sender(Yii::$app->params['sms_login'], Yii::$app->params['sms_passwd']);
                $messages = $messages->messageObj;
                $messages->setUrl(Yii::$app->params['sms_host']);
                $mes = $messages->createNewMessage(Yii::$app->params['sms_sender'], $code, 'sms');

                $abonent = $mes->createAbonent($phone);
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
        $auth = User::find()->where(['source' => $client->getId(), 'source_id' => $attributes['id']])->one();

        if (Yii::$app->user->isGuest) {
            if (!empty($auth) && Yii::$app->user->login($auth)) { // login

            } else { // signup
                if (isset($attributes['email']) && User::find()->where(['email' => $attributes['email']])->exists()) {
                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't linked to it. Login using email first to link it.", ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    if (isset($attributes['name']['givenName']) && isset($attributes['name']['familyName'])) {
                        if (User::find()->where(['username' => $attributes['first_name'] . $attributes['last_name']])->exists()) {
                            $user_name = $attributes['first_name'] . $attributes['last_name'] . rand(0, 100);
                        } else {
                            $user_name = $attributes['first_name'] . $attributes['last_name'];
                        }
                        $full_name = isset($attributes['first_name'])? $attributes['first_name'] : '';
                        $login = strtolower($this->translit($full_name));
                        $full_name .= isset($attributes['last_name'])? ' '.$attributes['last_name'] : '';
                        $login .= strtolower($this->translit(isset($attributes['last_name'])? '_'.$attributes['last_name'] : ''));
                        if ($login) {
                            if (User::find()->where(['username' => $login])->exists()) {
                                $login = $login.rand(0,100);
                            }
                        }
                        $user = new User([
                            'username' => $login,
                            'first_name' =>  isset($attributes['first_name'])? $attributes['first_name'] : '',
                            'last_name' =>  isset($attributes['last_name'])? $attributes['last_name'] : '',
                            'email' => isset($attributes['emails'][0]['value']) ? $attributes['emails'][0]['value'] : null,
                            'password_hash' => Yii::$app->security->generatePasswordHash($password),
                            'social_access_token' => $access_token,
                            'source' => $client->getId(),
                            'source_id' => $attributes['id'],
                            'created_at' => time(),
                            'updated_at' => time(),
                            'status' => 10
                        ]);
                        $user->generateAuthKey();
                        $user->generateAccessToken();
                        $user->generatePasswordResetToken();
                        $user->save(false);
                        $userRole = Yii::$app->authManager->getRole('user');
                        Yii::$app->authManager->assign($userRole, $user->id);
                        if ($user->save(false) && Yii::$app->user->login($user)) {
                            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
                            $this->redirect(['site']);

                        } else {
                            print_r($user->getErrors());
                        }
                    } else {
                        if (User::find()->where(['username' => $attributes['first_name'] . $attributes['last_name']])->exists()) {
                            $user_name = $attributes['first_name'] . $attributes['last_name'] . rand(0, 100);
                        } else {
                            $user_name = $attributes['first_name'] . $attributes['last_name'];
                        }
                        $full_name = isset($attributes['first_name'])? $attributes['first_name'] : '';
                        $login = strtolower($this->translit($full_name));
                        $full_name .= isset($attributes['last_name'])? ' '.$attributes['last_name'] : '';
                        $login .= strtolower($this->translit(isset($attributes['last_name'])? '_'.$attributes['last_name'] : ''));
                        if ($login) {
                            if (User::find()->where(['username' => $login])->exists()) {
                                $login = $login.rand(0,100);
                            }
                        }
                        $user = new User([
                            'username' => $login,
                            'first_name' =>  isset($attributes['first_name'])? $attributes['first_name'] : '',
                            'last_name' =>  isset($attributes['last_name'])? $attributes['last_name'] : '',
                            'email' => isset($attributes['email']) ? $attributes['email'] : null,
                            'password_hash' => Yii::$app->security->generatePasswordHash($password),
                            'social_access_token' => $access_token,
                            'source' => $client->getId(),
                            'source_id' => $attributes['id'],
                            'photo' => isset($attributes['photo']) ? $attributes['photo'] : '',
                            'created_at' => time(),
                            'updated_at' => time(),
                            'status' => 10
                        ]);
                        $user->generateAuthKey();
                        $user->generateAccessToken();
                        $user->generatePasswordResetToken();
                        $user->save(false);
                        $userRole = Yii::$app->authManager->getRole('user');
                        Yii::$app->authManager->assign($userRole, $user->id);
                        if ($user->save(false) && Yii::$app->user->login($user)) {
                            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');

                        } else {
                            print_r($user->getErrors());
                        }
//                        }

                    }


                }
            }
        } else { // user already logged in

        }

    }
}
