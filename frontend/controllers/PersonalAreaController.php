<?php

namespace frontend\controllers;

use backend\components\Sender;
use backend\models\News;
use common\models\Hotels;
use common\models\Invoice;
use common\models\Sms;
use common\models\User;
use frontend\models\EmplayeeForm;
use frontend\models\UserSearch;
use mdm\admin\models\form\ChangePassword;
use Yii;
use yii\authclient\AuthAction;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\httpclient\CurlTransport;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\httpclient\Client;
/**
 * Site controller
 */
class PersonalAreaController extends Controller
{
    public $layout = 'main_';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'employe', 'send-code'],
                'rules' => [
                    [
                        'actions' => ['index', 'search', 'logout'],
                        'allow' => true,
                        'roles' => ['manager',''],
                    ],
                    [
                        'actions' => ['logout', 'signup', 'employe'],
                        'allow' => true,
                        'roles' => ['director'],
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
        $user = new User();
        $invoice = new Invoice();
        $user = $user::findOne(Yii::$app->user->identity->getId());
        $hotel = new Hotels();
        $hotel = $hotel::findOne($user->hotel_id);
        if (\backend\components\User::getRoleName() == 'director' && $hotel->load(Yii::$app->request->post()) && $hotel->save()) {
            Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
        }
        $changePassword = new ChangePassword();
        return $this->render('index', [
            'hotel' => $hotel,
            'model' => $user,
            'changePassword' => $changePassword,
            'invoice' => $invoice
        ]);
    }

    /**
     * actionChangePassword
     *
     * @return mixed
     */
    public function actionChangePassword()
    {
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setUrl('http://example.com/api/1.0/users')
            ->setData(['name' => 'John Doe', 'email' => 'johndoe@example.com'])
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data['id'];
        }
        $user = new ChangePassword();
        if ($user->load(Yii::$app->request->post()) && $user->change()) {
            Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка при сохранении');
        }
        $this->redirect('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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
    public function actionEmploye()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('employe', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new EmplayeeForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success', 'Сотрудник успешно добавлено');
                return $this->redirect(['personal-area/employe']);
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

    public function actionDelete($id)
    {
        $user = new User();
        $user::findOne($id)->delete();

        return $this->redirect(['employe']);
    }

    /**
     * @param $client
     * @return \yii\web\Response
     */
    public function successCallback($client)
    {
        $attributes = $client->getUserAttributes();
        $access_token = $client->getAccessToken()->getToken();
        $id = ArrayHelper::getValue($attributes, 'id');
        $socialName = $client->getName();
        if (!Yii::$app->user->isGuest && $id) {
            $user = new User();
            $user = $user::findOne(Yii::$app->user->identity->getId());
            if (!empty($user)) {
                if ($socialName === 'facebook') {
                    $user->facebook_id = $id;
                }
                if ($socialName === 'vkontakte') {
                    $user->vkontakte_id = $id;
                }
                if ($socialName === 'google') {
                    $user->google_id = $id;
                }
                if ($user->save()) {
                    Yii::$app->session->setFlash('success', 'СоцСет ' . $socialName . ' подключен!');
                    return $this->redirect(['personal-area/index']);
                }
            }
        }

    }

}
