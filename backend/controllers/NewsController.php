<?php

namespace backend\controllers;

use backend\components\Importer;
use backend\models\ImportForm;
use Yii;
use backend\models\News;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends Controller
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
                        'actions' => ['logout', 'news-cancel', 'import-csv', 'delete-image', 'view', 'news-success', 'update', 'delete', 'create', 'index', 'create-user'],
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
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
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
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $body = "Добавлено новост <a href='" . Yii::$app->params['domain'] . "admin/news/view?id={$model->id}'>Просмотр</a>" .
                "<p> Заголовок: {$model->title}</p>"
                . "<p> Дата: {$model->date}</p>"
                . "<p> Кароткая описание: {$model->short_content}</p>"
                . "<p> Описание: {$model->content}</p>";
            $this->sendEmail($body);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                $oldModel = $this->findModel($id);
                $body = $this->checkBlackList($model, $oldModel);
                $this->sendEmail($body);
            }
        }
        $model->date = date("d.m.Y", strtotime($model->date));

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing News model.
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

    /** удаления фото новости
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeleteImage($id)
    {
        $model = $this->findModel($id);
        if (file_exists(Yii::getAlias('@frontend') . '/web/uploads/news/' . $model->img)) {
            unlink(Yii::getAlias('@frontend') . '/web/uploads/news/' . $model->img);
            $model->img = '';
            $model->save();
        }
        return $this->redirect(['update', 'id' => $id]);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNewsSuccess()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('id');
            $list = News::findOne($id);
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

    public function actionNewsCancel()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->get('id');
            $list = News::findOne($id);
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

    protected function sendEmail($body)
    {
        return \Yii::$app
            ->mailer
            ->compose()
            ->setFrom(['group.scala@mail.ru' => 'Robot'])
            ->setTo(Yii::$app->params['notification'])
            ->setSubject('Rucexpert')
            ->setHtmlBody($body)
            ->send();
    }

    protected function checkBlackList($model, $pastModel)
    {
        $body = '';
        if ($model->title != $pastModel->title) {
            $body .= '<p>  Поле Заголовок было: ' . $pastModel->title . ' стало ' . $model->title . '</p>';
        }
        if ($model->date != $pastModel->date) {
            $body .= '<p>  Поле Дата было: ' . $pastModel->date . ' стало ' . $model->date . '</p>';
        }
        if ($model->short_content != $pastModel->short_content) {
            $body .= '<p> Поле Кароткая описание было: ' . $pastModel->short_content . ' стало ' . $model->short_content . '</p>';
        }
        if ($model->content != $pastModel->content) {
            $body .= '<p> Поле Кароткая описание было: ' . $pastModel->content . ' стало ' . $model->content . '</p>';
        }

        return $body;
    }

    /**
     * Импорт новостей из csv файла
     */
    public function actionImportCsv()
    {
        $importForm = new ImportForm();
        //путь к файлу
        if (Yii::$app->request->post() && $importForm->load(Yii::$app->request->post())) {
            $uploadFile = UploadedFile::getInstance($importForm, 'file');
            try {
                $importer = Importer::importCsvNews($uploadFile);
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
}
