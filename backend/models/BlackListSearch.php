<?php

namespace backend\models;

use backend\components\User;
use common\models\Hotels;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\BlackList;
use yii\helpers\ArrayHelper;

/**
 * BlackListSearch represents the model behind the search form of `backend\models\BlackList`.
 */
class BlackListSearch extends BlackList
{
    public $searching;
    public $type_db;

    public function __construct($config = [])
    {
        $rubric = new Rubric();
        $rubric = $rubric::find()->all();
        $this->type_db = ArrayHelper::map($rubric, 'id', 'title');

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'moder', 'type_org', 'user_id', 'status'], 'integer'],
            [['first_name', 'searching', 'last_name', 'middle_name', 'comment', 'date_born', 'place_born', 'moder_comment', 'ser_num_car', 'phone', 'email'], 'safe'],
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
        $query = BlackList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date_born' => $this->date_born,
            'moder' => $this->moder,
            'type_org' => $this->type_org,
            'user_id' => $this->user_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'place_born', $this->place_born])
            ->andFilterWhere(['like', 'moder_comment', $this->moder_comment])
            ->andFilterWhere(['like', 'ser_num_car', $this->ser_num_car])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }

    public function searchByFilter($params)
    {
        $query = BlackList::find();
        $isAdmin = User::getRoleName() == 'admin';
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->where(['status' => 2]);
        $this->load($params);
        $rubric = new Rubric();
        $price = 0;
        if ($this->type_org) {
            $rubric = $rubric::findOne($this->type_org);
            $price = (float)$rubric->price;
        }
        if ($isAdmin && $this->searching) {

            if (!$this->validate()) {
                // uncomment the following line if you do not want to return any records when validation fails
                // $query->where('0=1');
                return $dataProvider;
            }

            // grid filtering conditions
            $query->andFilterWhere([
                'id' => $this->id,
                'date_born' => $this->date_born,
                'moder' => $this->moder,
                'type_org' => $this->type_org,
                'user_id' => $this->user_id,
            ]);

            $query->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'middle_name', $this->middle_name])
                ->andFilterWhere(['like', 'comment', $this->comment])
                ->andFilterWhere(['like', 'place_born', $this->place_born])
                ->andFilterWhere(['like', 'moder_comment', $this->moder_comment])
                ->andFilterWhere(['like', 'ser_num_car', $this->ser_num_car]);

            return $dataProvider;
        }


    }
}
