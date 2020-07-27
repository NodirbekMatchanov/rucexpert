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
     * @param $url
     * @return string|\yii\web\Response
     */
    public function actionRubric($url)
    {
        $model = new News();
        $rubric = News::getRubric();
        if (isset($rubric[$url])) {
            $rubricId = $rubric[$url];
        } else {
            return $this->redirect('/news');
        }
        $otherNews = NewsSearch::getOtherNews($rubricId);
        $news = $model::find()->where(['rubric_id' => $rubricId, 'status' => 2]);
        $pageData = clone $news;
        $page = new Pagination(['totalCount' => $pageData->count(), 'pageSize' => 2, 'defaultPageSize' => 2]);
        $newsItems = $pageData->orderBy('id desc')->offset($page->offset)->limit($page->limit)->all();
        return $this->render('rubric', [
            'model' => $newsItems,
            'otherNews' => $otherNews,
            'rubricId' => $rubricId,
            'url' => $url,
            'pages' => $page,
        ]);
    }

    public function actionSearch()
    {
        if (Yii::$app->request->post()) {
            $search = Yii::$app->request->post('search');
            $model = new NewsSearch();
            $news = $model->search( $search);
            $pageData = clone $news;
            $page = new Pagination(['totalCount' => $pageData->count(), 'pageSize' => 8, 'defaultPageSize' => 8]);
            $newsItems = $pageData->orderBy('id desc')->offset($page->offset)->limit($page->limit)->all();
            return $this->render('search', [
                'model' => $newsItems,
                'pages' => $page,
                'q' => $search,
            ]);
        } else {
            return $this->redirect('/news');
        }
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
