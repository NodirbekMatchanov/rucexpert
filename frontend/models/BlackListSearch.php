<?php

namespace frontend\models;

use backend\components\User;
use backend\models\Rubric;
use common\models\Hotels;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BlackList;
use yii\helpers\ArrayHelper;

/**
 * BlackListSearch represents the model behind the search form of `common\models\BlackList`.
 */
class BlackListSearch extends BlackList
{
    public $type_db;
    public $hotel;
    public $searching = false;


    public function __construct($config = [])
    {
        $rubric = new Rubric();
        $rubric = $rubric::find()->all();
        $this->type_db = ArrayHelper::map($rubric, 'id', 'title');
        $hotel = Hotels::findOne(\Yii::$app->getUser()->identity->hotel_id);
        $this->hotel = $hotel;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'moder', 'type_org', 'user_id'], 'integer'],
            [['searching', 'first_name', 'last_name', 'middle_name', 'date_public', 'comment', 'date_born', 'place_born', 'moder_comment', 'ser_num_car'], 'safe'],
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
        if (($isAdmin && $this->searching) || $this->searching && (($this->hotel->balance >= $price || $this->hotel->count_bonus_find))) {
            if (!$isAdmin) {
                if ($this->hotel->count_bonus_find) {
                    $this->hotel->count_bonus_find = $this->hotel->count_bonus_find - 1;
                } else {
                    $this->hotel->balance = $this->hotel->balance - $price;
                }
            }
            if ($isAdmin || $this->hotel->save()) {

                if (!$this->validate()) {
                    // uncomment the following line if you do not want to return any records when validation fails
                    // $query->where('0=1');
                    return $dataProvider;
                }
                $query->andWhere('date_public <= "'. date("Y-m-d H:i:s").'"');
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

        } else {
            $query->where(['id' => 0]);
            if ($this->searching) {
                \Yii::$app->session->setFlash('error', 'Не достаточно средство! Пополняйте пожалуйста счет');
            }
            return $dataProvider;
        }

    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchMyBlackList($params)
    {
        $query = BlackList::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if(User::getRoleName(\Yii::$app->user->identity->id) == 'director') {
            $users = \common\models\User::find()->where(['parent_id' => \Yii::$app->user->identity->id])-> all();
            $userList = [];
            array_push($userList,\Yii::$app->user->identity->id);
            foreach ($users as $user){
                array_push($userList,$user->id);
            }
            $userIds = implode(',',$userList);
            $query->where('user_id IN('.$userIds.')');
        } else {
            $query->where(['user_id' => \Yii::$app->user->identity->id]);
        }
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
