<?php

namespace backend\controllers;

use backend\models\Gallery;
use backend\models\ImportForm;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use Yii;
use backend\models\BlackList;
use backend\models\BlackListSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use backend\components\Importer;

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
                        'actions' => ['logout', 'delete-all', 'search', 'accept-all', 'import-csv', 'admin-cancel', 'view', 'admin-success', 'update', 'delete', 'create', 'index', 'create-user'],
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
     * Lists all BlackList models.
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new BlackListSearch();
        $dataProvider = $searchModel->searchByFilter(Yii::$app->request->post());
        return $this->render('search', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    /**
     * @return bool
     */
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

    /**
     * @return bool
     */
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

    /**
     * Импорт нарушителей из csv файла
     */
    public function actionImportCsv()
    {
        $importForm = new ImportForm();
        //путь к файлу
        if (Yii::$app->request->post() && $importForm->load(Yii::$app->request->post())) {
            $uploadFile = UploadedFile::getInstance($importForm, 'file');
            try {
                $importer = Importer::importCsv($uploadFile, $importForm->count, $importForm->time);
            } catch (\Exception $e) {
                Yii::info($e);
                throw new HttpException(500, 'Ошибка обработка данных');
            }
            if ($importer) {
                Yii::$app->session->setFlash('success', 'Загруженное количество данных: ' . $importer);
            }
        }
        return $this->render('import', [
            'importForm' => $importForm
        ]);
    }

    /**
     * удаления по выборку
     */
    public function actionDeleteAll()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $ids = Yii::$app->request->post('selectedItems');
            foreach ($ids as $id) {
                $this->findModel($id)->delete();
            }

        }
        if (Yii::$app->request->get('id') == 'all') {
            BlackList::deleteAll();
            return $this->redirect('index');
        }
        return true;
    }

    /**
     * удаления по выборку
     */
    public function actionAcceptAll()
    {
        if (Yii::$app->request->isAjax && Yii::$app->request->post()) {
            $ids = Yii::$app->request->post('selectedItems');
            $model = new BlackList();
            foreach ($ids as $id) {
                $model = $model::findOne($id);
                $model->status = 2;
                $model->save();
            }
        }
        return true;
    }


}
