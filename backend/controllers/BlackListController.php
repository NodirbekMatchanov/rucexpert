<?php

namespace backend\controllers;

use backend\models\Gallery;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Yii;
use backend\models\BlackList;
use backend\models\BlackListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * BlackListController implements the CRUD actions for BlackList model.
 */
class BlackListController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'admin-cancel', 'view', 'admin-success',  'update', 'delete', 'create', 'index', 'create-user'],
                        'allow' => true,
                        'roles' => ['@'],
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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        $model = new \common\models\BlackList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        if (($model = \common\models\BlackList::findOne($id)) !== null) {
            $model->files = Gallery::findAll(['parent_id' => $model->id]);

            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAdminSuccess()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('id');
            $list = \common\models\BlackList::findOne($id);
            if (!empty($list)) {
                $list->status = 2;
                if ($list->save()) {
                    return true;
                }
            } else {
                return false;
            }
        }
    }

    public function actionAdminCancel()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('id');
            $list = \common\models\BlackList::findOne($id);
            if (!empty($list)) {
                $list->status = 3;
                if ($list->save()) {
                    return true;
                }
            } else {
                return false;
            }
        }
    }
}
