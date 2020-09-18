<?php

namespace frontend\controllers;

use backend\models\Pages;
use backend\models\Rubric;
use common\models\Video;
use frontend\models\NewsFeedBack;
use frontend\models\SignupForm;
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
        $newsPage = Pages::find()->where(['url' => 'news'])->one();
        $signModel = new SignupForm();
        return $this->render('index', [
            'newsItems' => $newsItems,
            'mainNews' => $mainNews,
            "signModel" => $signModel,
            'newsPage' => $newsPage,
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
        $signModel = new SignupForm();
        $otherNews = NewsSearch::getOtherNews($model->rubric_id);
        $video = Video::find()->where(['parent_id' => $id])->one();
        return $this->render('view', [
            'model' => $model,
            'otherNews' => $otherNews,
            'video' => $video,
            "signModel" => $signModel,
        ]);
    }

    /**
     * FeedBack form
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionFeedBack()
    {
        $model = new NewsFeedBack();
        $signModel = new SignupForm();
        if (Yii::$app->request->post() && $model->load(Yii::$app->request->post())) {
            try {
                $result = $model->sendFeedBack();
            } catch (\Exception $exception){
                Yii::info($exception);
                Yii::$app->session->setFlash('error', 'Ошибка при отправке');
                return $this->render('feedback', [
                    'model' => $model,
                ]);
            }
            Yii::$app->session->setFlash('success', 'Успешно отправлено');
        }
        return $this->render('feedback', [
            'model' => $model,
            "signModel" => $signModel,
        ]);
    }


    /**
     * @param $url
     * @return string|\yii\web\Response
     */
    public function actionRubric($url)
    {
        $model = new News();
        $signModel = new SignupForm();
        $rubric = News::getRubric();
        if (isset($rubric[$url])) {
            $rubricId = $rubric[$url];
        } else {
            return $this->redirect('/news');
        }
        $newsPage = Pages::find()->where(['url' => $url])->one();
        $otherNews = NewsSearch::getOtherNews($rubricId);
        $news = $model::find()->where(['rubric_id' => $rubricId, 'status' => 2])->andWhere('date <= "' . date("Y-m-d") . '"');
        $pageData = clone $news;
        $page = new Pagination(['totalCount' => $pageData->count(), 'pageSize' => 6, 'defaultPageSize' => 6]);
        $newsItems = $pageData->orderBy('id desc')->offset($page->offset)->limit($page->limit)->all();
        return $this->render('rubric', [
            'model' => $newsItems,
            'otherNews' => $otherNews,
            'rubricId' => $rubricId,
            'url' => $url,
            'pages' => $page,
            'newsPage' => $newsPage,
            "signModel" => $signModel,
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionSearch()
    {
        if (Yii::$app->request->post()) {
            $search = Yii::$app->request->post('search');
            $model = new NewsSearch();
            $news = $model->search($search);
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
