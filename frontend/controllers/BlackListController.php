<?php

namespace frontend\controllers;

use backend\models\Gallery;
use Yii;
use common\models\BlackList;
use frontend\models\BlackListSearch;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BlackListController implements the CRUD actions for BlackList model.
 */
class BlackListController extends Controller
{
    public $layout = 'main_';

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['search', 'delete'],
                'rules' => [
                    [
                        'actions' => ['search', 'delete'],
                        'allow' => true,
                        'roles' => ['director', 'admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BlackList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlackListSearch();
        $dataProvider = $searchModel->searchMyBlackList(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all BlackList models.
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new BlackListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());
        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BlackList model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new BlackList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BlackList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $body = '<p>Пользователь '.Yii::$app->user->identity->username. ' добавил нового нарушителя 
                  <a href="' . Yii::$app->params['domain'] . 'admin/black-list/view?id=' . $model->id . '"> Просмотр</a></p>';
            try {
                $this->sendEmail($body);
            } catch (\Exception $e) {
                Yii::info($e);
            }
            $this->sendEmail($body);
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BlackList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $body = '<p>Пользователь ' .Yii::$app->user->identity->username. ' обновил запись нарушителя 
                <a href="' . Yii::$app->params['domain'] . 'admin/black-list/view?id=' . $model->id . '"> Просмотр</a> </p>';
            try {
                $this->sendEmail($body);
            } catch (\Exception $e) {
                Yii::info($e);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BlackList model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BlackList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlackList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlackList::findOne($id)) !== null) {
            $model->files = Gallery::findAll(['parent_id' => $model->id]);
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function sendEmail($body)
    {
        return \Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['group.scala@mail.ru' => 'Robot'])
            ->setTo(Yii::$app->params['notification'])
            ->setSubject('Пользователь добавил нового рарушителя')
            ->setHtmlBody($body)
            ->send();
    }
}
