<?php

namespace frontend\controllers;

use backend\models\Rubric;
use common\models\Video;
use Yii;
use common\models\News;
use frontend\models\NewsSearch;
use yii\data\Pagination;
use yii\web\Controller;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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

        $newsItems = NewsSearch::getNewsByRubric();
        $mainNews = NewsSearch::getMainNews();
//        $pageData = clone $news;
//        $page = new Pagination(['totalCount' => $pageData->count(), 'pageSize' => 4, 'defaultPageSize' => 4]);
//        $newsItems = $pageData->orderBy('id desc')->offset($page->offset)->limit($page->limit)->all();
        return $this->render('index', [
            'newsItems' => $newsItems,
            'mainNews' => $mainNews,
//            'pages' => $page,
//            'rubric' => $rubric,
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
        $model = $this->findModel($id);
        $otherNews = NewsSearch::getOtherNews($model->rubric_id);
        $video = Video::find()->where(['parent_id' => $id])->one();
        return $this->render('view', [
            'model' => $model,
            'otherNews' => $otherNews,
            'video' => $video,
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
            return $this->redirect(['view', 'id' => $model->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionRubric($url){
        $model = new News();
        $rubric = News::getRubric();
        if(isset($rubric[$url])){
          $rubricId = $rubric[$url];
        } else {
            return $this->redirect('/news');
        }
        $otherNews = NewsSearch::getOtherNews($rubricId);
        $news = $model::find()->where(['rubric_id' => $rubricId])->all();
        return $this->render('rubric',[
           'model' => $news,
           'otherNews' => $otherNews,
           'rubricId' => $rubricId,
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
}
