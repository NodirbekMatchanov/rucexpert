<?php

namespace frontend\models;

use backend\models\Rubric;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\News;

/**
 * NewsSearch represents the model behind the search form of `common\models\News`.
 */
class NewsSearch extends News
{
    public  $search;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rubric_id'], 'integer'],
            [['title', 'content', 'date', 'creator', 'img'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = News::find();

        // add conditions that should always apply here


        $query->where(['status' => 2]);
//        $this->load($params);

        $query->andFilterWhere(['like', 'title', $params])
            ->orWhere(['like', 'content', $params]);

        return $query;
    }

    public function searchIndex($params)
    {
        $query = News::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $query;
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'rubric_id' => isset($params['rubric_id']) ? $params['rubric_id'] : '',
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'img', $this->img]);

        return $query;
    }

    public static function getNewsByRubric()
    {
        $rubricModel = new Rubric();
        $rubrics = $rubricModel::find()->all();
        $newsList = [];
        foreach ($rubrics as $rubric) {
            $newsList [] = [
                'news' => self::find()->where(['rubric_id' => $rubric->id])->andWhere(['status' => 2])->orderBy(['id' => 'desc'])->asArray()->all(),
                'title' => $rubric->title
            ];
        }
        return $newsList;
    }

    public static function getOtherNews($rubric_id)
    {
        $rubricModel = new Rubric();
        $rubrics = $rubricModel::find()->where(['!=','id', $rubric_id])->all();
        $newsList = [];
        foreach ($rubrics as $rubric) {
            $newsList [] = [
                'news' => self::find()->where(['rubric_id' => $rubric->id])->andWhere(['status' => 2])->orderBy(['id' => 'desc'])->asArray()->all(),
                'title' => $rubric->title
            ];
        }
        return $newsList;
    }

    public static function getMainNews()
    {
        return self::find()->orderBy(['id' => 'desc'])->andWhere(['status' => 2])->limit(1)->one();
    }

    // Todo нужно перенести в отдельный helper класс
    public static function getMonthString($date)
    {
        $date = str_replace('.', '-', $date);
        $_mD = date("m", strtotime($date)); //для замены
        $day = date("d", strtotime($date)); //для замены
        $day = date("d", strtotime($date)); //для замены
        $months = ["ЯНВ", "ФЕВ", "МАР", "АПР", "МАЙ", "ИЮН", "ИЮЛ", "АВГ", "СЕН", "ОКТ", "НОЯ", "ДЕК"];
        $month = $months[(int)$_mD - 1];
        return ['day' => $day, 'month' => $month];
    }
}
